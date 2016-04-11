<?
	class ProductModel {
		protected $m_db;
		protected $m_product_tbl_name;
		protected $m_product_category_tbl_name;
		protected $m_product_filter_group_tbl_name;
		protected $m_product_filter_val_tbl_name;
		protected $m_product_price_tbl_name;

		protected $m_filter_model;

		public function __construct($_db, 
			$product_tbl_name = "product_info", 
			$product_category_tbl_name = "product_category",
			$product_filter_group_tbl_name = "product_filter_group",
			$product_filter_val_tbl_name = "product_filter_value",
			$product_price_tbl_name = "product_price") 
		{

			$this->m_product_tbl_name = $product_tbl_name;
			$this->m_product_category_tbl_name = $product_category_tbl_name;
			$this->m_product_filter_group_tbl_name = $product_filter_group_tbl_name;
			$this->m_product_filter_val_tbl_name = $product_filter_val_tbl_name;
			$this->m_product_price_tbl_name = $product_price_tbl_name;

			$this->m_db = $_db;

			$this->m_filter_model = new FilterModel($this->m_db);
		}
		public function GetByID($id) {
			$query_string = "SELECT * FROM $this->m_product_tbl_name WHERE id=$id;";
			$result = QueryEx($query_string, array(), $this->m_db);
			$result = $result[0];

			$result["RATING"] = $this->GetRating($id);

			if($result["IMAGE_NAME"] == "") {
				$result["IMAGE_NAME"] = "placeholder.gif";
			}

			return $result;
		}

		public function GetPrices($id) {
			$price_data = QueryEx("SELECT * FROM price_info;", array(), $this->m_db);
			$price_info = array();
			foreach($price_data as $key => $value) {
				$price_info[$value["ID"]] = $value;
			}

			$prices = QueryEx("SELECT * FROM product_price WHERE product_id=$id;", array(), $this->m_db);

			$result = array();
			foreach($prices as $price) {
				$result[$price["PRICE_ID"]] = array(
					"TYPE_ID" => $price["PRICE_ID"],
					"TYPE_NAME" => $price_info[$price["PRICE_ID"]]["NAME"],
					"TYPE_CODE" => $price_info[$price["PRICE_ID"]]["CODE"],
					"VALUE" => $price["VALUE"]
				);
			}
			return $result;
		}

		public function GetFilterValues($id) {
			$query_string = "SELECT * FROM product_filter_value WHERE product_id = $id;";
			$result = QueryEx($query_string, array(), $this->m_db);
			return $result;
		}
		public function GetList($category_id = -1, $page = -1, $page_size = -1) {
			$query_string = "SELECT info.* FROM product_category AS a 
							 JOIN product_info AS info ON info.id = a.product_id
							 WHERE category_id IN (SELECT descendant FROM category_closure WHERE ancestor = $category_id)";
			if($page != -1 && $page_size != -1) {
				$min = $page * $page_size;
				$max = $min + $page_size;
				$query_string .= " LIMIT $min, $max;";
			} else {
				$query_string .= ";";
			}
			$result = QueryEx($query_string, array(), $this->m_db);
			return $result;
		}

		public function GetListExOLD($category_id = -1, $manufacturer_id = -1, $page = -1, $page_size = -1) {
			$query_string = "SELECT info.* FROM product_category AS a 
							 JOIN product_info AS info ON info.id = a.product_id
							 WHERE category_id IN (SELECT descendant FROM category_closure WHERE ancestor = $category_id)
							 AND manufacturer_id = $manufacturer_id;";
			if($page != -1 && $page_size != -1) {
				$min = $page * $page_size;
				$max = $min + $page_size;
				$query_string .= " LIMIT $min, $max;";
			} else {
				$query_string .= ";";
			}
			$result = QueryEx($query_string, array(), $this->m_db);
			return $result;
		}

		public function GetListEx($param) {
			if(isset($param["GET_COUNT"])) {
				$query_string = "SELECT COUNT(*) AS count FROM product_category AS cat JOIN product_info AS info ON info.id = cat.product_id ";
			} else {
				$query_string = "SELECT info.*, price.value AS price FROM product_category AS cat JOIN product_info AS info ON info.id = cat.product_id ";
			}
			
			$price_id = isset($param["PRICE_ID"]) ? $param["PRICE_ID"] : 1;

			$query_string .= " JOIN product_price AS price ON price.product_id = info.id AND price.price_id = $price_id ";

			
			if(isset($param["FILTER"])) {
				$basic_query = "INNER JOIN (SELECT A.* FROM product_filter_value AS A ";
				$counter = 0;
				foreach($param["FILTER"] as $filter) {
					$group_id = $filter["GROUP_ID"];
					$value_id = $filter["VALUE_ID"];
					$join_part = "INNER JOIN 
								 (SELECT product_id 
								  FROM product_filter_value 
								  WHERE filter_group_id = $group_id AND filter_value_id = $value_id) 
								  AS B{$counter} 
								  USING(product_id) ";
					$basic_query .= $join_part;
					$counter++;
				}
				$basic_query .= " GROUP BY product_id) AS filter ON filter.product_id = info.id ";
				$query_string .= $basic_query;
			}
			if(isset($param["CATEGORY_ID"]) || isset($param["MANUFACTURER_ID"]) || isset($param["NAME_LIKE"])) {
				$category_subquery = "";
				$manufacturer_subquery = "";
				$namelike_subquery = "";
				$price_min_subquery = "";
				$price_max_subquery = "";

				if(isset($param["CATEGORY_ID"])) {
					$category_id = $param["CATEGORY_ID"];
					$category_subquery = "category_id IN (SELECT descendant FROM category_closure WHERE ancestor = $category_id)";
				}
				if(isset($param["MANUFACTURER_ID"])) {
					$manufacturer_id = $param["MANUFACTURER_ID"];
					$manufacturer_subquery = "manufacturer_id = $manufacturer_id";
				}
				if(isset($param["NAME_LIKE"])) {
					$name_like = "%" . $param["NAME_LIKE"] . "%";
					$name_like = $this->m_db->quote($name_like);
					$namelike_subquery = "name LIKE $name_like";
				}

				if(isset($param["PRICE_MIN"])) {
					$price_min = floatval($param["PRICE_MIN"]) - 0.001;
					$price_min_subquery = " price.value > $price_min ";
				}

				if(isset($param["PRICE_MAX"])) {
					$price_max = floatval($param["PRICE_MAX"]) + 0.001;
					$price_max_subquery = " price.value < $price_max ";
				}

				$query_string .= " WHERE ";

				if($category_subquery != "") {
					$query_string .= $category_subquery;
				} else {
					$query_string .= "TRUE";
				}

				$query_string .= " AND ";

				if($manufacturer_subquery != "") {
					$query_string .= $manufacturer_subquery;
				} else {
					$query_string .= "TRUE";
				}

				$query_string .= " AND ";

				if($namelike_subquery != "") {
					$query_string .= $namelike_subquery;
				} else {
					$query_string .= "TRUE";
				}

				$query_string .= " AND ";

				if($price_min_subquery != "") {
					$query_string .= $price_min_subquery;
				} else {
					$query_string .= "TRUE";
				}

				$query_string .= " AND ";

				if($price_max_subquery != "") {
					$query_string .= $price_max_subquery;
				} else {
					$query_string .= "TRUE";
				}
			}
			
			if(isset($param["ORDER"])) {
				$order = $param["ORDER"]["VALUE"] == "ASC" ? "ASC" : "DESC";
				if($param["ORDER"]["FIELD"] == "PRICE") {
					$query_string .= " ORDER BY price.value $order";
				} elseif($param["ORDER"]["FIELD"] == "NAME") {
					$query_string .= " ORDER BY name $order ";
				}
			}

			if(isset($param["PAGE"]) && isset($param["PAGE_SIZE"]) && !isset($param["GET_COUNT"])) {
				$min = intval($param["PAGE"]) * intval($param["PAGE_SIZE"]);
				$max = $min + intval($param["PAGE_SIZE"]);
				$query_string .= " LIMIT $min, $max";
			}

			$query_string .= ";";

			return QueryEx($query_string, array(), $this->m_db);
		}

		public function GetRating($id) {
			$query_string = "SELECT * FROM product_rating WHERE product_id = $id;";
			$result = QueryEx($query_string, array(), $this->m_db);
			$rating = array(
				"SUM" => 0.0,
				"COUNT" => 0,
				"AVERAGE" => 0
			);
			if(is_array($result)) {
				foreach($result as $value) {
					$rating["SUM"] += floatval($value["VALUE"]);
					$rating["COUNT"]++;
				}
				$rating["AVERAGE"] = $rating["SUM"] / $rating["COUNT"];
			}
			return $rating;
		}

		public function GetStoreCount($id) {
			$query_string = "SELECT * FROM product_store WHERE product_id = $id";
			$result = QueryEx($query_string, array(), $this->m_db);
			if(is_array($result)) {
				return $result[0]["COUNT"];
			} else {
				return -1;
			}
		}

		public function GetCategoryID($id) {
			$query_string = "SELECT category_id FROM product_category WHERE product_id = $id";
			$result = QueryEx($query_string, array(), $this->m_db);
			if(is_array($result)) {
				return $result[0]["CATEGORY_ID"]; 
			} else {
				return $result;
			}
		}

		public function AddProduct() {
			
		}


		// Filter related functionality
		public function AssignFilter($product_id, $filter_value_Id) {

		}
		public function RemoveFilter($product_id, $filter_value_id) {

		}
	}

	class FilterModel {
		private $m_db;
		public function __construct($db) {
			$this->m_db = $db;
		}

		public function AssignCategory($category_id, $filter_group_id) {

		}
		public function RemoveCategory($category_id, $filtr_group_id) {

		}
		public function IsAllowedCategory($category_id, $filter_group_id) {
			
		}
	}
?>