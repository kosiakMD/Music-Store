<?
	class ManufacturerModel {
		private $m_db;
		private $m_manf_tbl_name;
		public function __construct($_db, $manf_tbl_name = "manufacturer_info") {
			$this->m_db = $_db;
			$this->m_manf_tbl_name = $manf_tbl_name;
		}

		public function GetByCode($code) {
			$query_string = "SELECT * FROM $this->m_manf_tbl_name WHERE code = :code";
			$result = QueryEx($query_string, array(":code" => $code), $this->m_db);
			return $result;
		}

		public function GetByID($id) {
			if(!is_numeric($id)) {
				$id = intval($id);
			}
			$query_string = "SELECT * FROM $this->m_manf_tbl_name WHERE id = $id";
			$result = QueryEx($query_string, array(), $this->m_db);
			if(is_array($result)) {
				$result = $result[0];
				if($result["IMAGE"] == "") {
					$result["IMAGE"] = "placeholder.gif";
				} 

			} else {
				return false;
			}
			return $result;
		}

		public function GetList($param) {
			if(isset($param["CATEGORY_ID"])) {
				$query_string = "SELECT manf_info.* FROM product_category AS a 
				JOIN product_info AS info ON info.id = a.product_id
				JOIN manufacturer_info AS manf_info ON manf_info.id = info.manufacturer_id
				WHERE category_id IN (SELECT descendant FROM category_closure WHERE ancestor = :CATEGORY_ID) GROUP BY info.manufacturer_id;";
			} else {
				$query_string = "SELECT manf_info.* FROM product_info AS info
								 JOIN manufacturer_info AS manf_info ON info.manufacturer_id = manf_info.id
								 GROUP BY info.manufacturer_id;";
			}
			
			$result = QueryEx($query_string, $param, $this->m_db);
			foreach($result as $value) {
				if($value["IMAGE"] == "") {
					$value["IMAGE"] = "placeholder.gif";
				}
			}
			return $result;
		}
	}