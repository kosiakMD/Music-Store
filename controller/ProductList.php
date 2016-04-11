<?
	// $manf_model = new ManufacturerModel($DB);
	// $brand = $manf_model->GetByCode(array_head(array_reverse($path)));
	// echo "brand:";
	// print_r($brand);


	function FillTemplate($DB, $path, $page = 0) {
		$product_model = new ProductModel($DB);
		$category_model = new CategoryTreeModel($DB);
		$manufacturer_model = new ManufacturerModel($DB);

		$category_path_string = "";

		$template = array();
		$param = array();
		$param["PAGE_SIZE"] = 32;

		$param["PAGE"] = $page;

		$template["BASE_URL"] = '/shop/'.$path;

		// retrieve brand and category path
		// $brand = $manufacturer_model->GetByCode(array_head(array_reverse($path)));


		// if($brand != null) {
		// 	$template["BRAND_INFO"] = $brand[0];
		// 	$param["MANUFACTURER_ID"] = $brand[0]["ID"];
		// 	$category_path_string = implode("/", array_values(array_reverse(array_tail(array_reverse(array_tail($path))))));
		// } else {
		// 	$category_path_string = implode("/", array_values(array_tail($path)));
		// }
		// $node_id = $category_model->GetCategoryIDByPath($category_path_string);

		// $template["CATEGORY_PATH_STRING"] = $category_path_string;

		// $brand = $manufacturer_model->GetByCode(
		// 	array_head(
		// 		array_reverse(
		// 			array_filter(
		// 				explode('/',$path)))));
		// if($brand != null) {
		// 	$param['MANUFACTURER_ID'] = array_first($brand);
		// } else {
		// 	$param['CATEGORY_PATH']
		// }

		$path_array = array_filter(explode('/', $path));

		if($brand = array_first($manufacturer_model->GetByCode(array_head(array_reverse($path_array))))) {
			$path_array = array_reverse(array_tail(array_reverse($path_array)));
			$param['MANUFACTURER_ID'] = $brand['ID'];
			$template['BRAND_INFO'] = $brand;
		} 

		$path = implode('/', $path_array);

		$template['CATEGORY_PATH_STRING'] = $path;
		$node_id = $category_model->GetCategoryIDByPath($path);

		if(is_numeric($node_id)) {
			$param["CATEGORY_ID"] = $node_id;
			$template["FULL_PATH"] = $category_model->GetNodePath($node_id);
			$template["FULL_PATH"] = array_cons(array("ID" => "0", "CODE" => "shop", "NAME" => "Главная"), $template["FULL_PATH"]);
			if(count($template["FULL_PATH"]) > 1) {
				$current_path = "";
				foreach($template["FULL_PATH"] as $key => $value) {
					$template["FULL_PATH"][$key]["URL"] = $current_path . "/" . $value["CODE"] . "/";
					$template["FULL_PATH"][$key]["IS_LAST"] = false;
					$current_path .= "/" . $value["CODE"];
				}
			}
			$template["FULL_PATH"][max(array_keys($template["FULL_PATH"]))]["IS_LAST"] = true;
		} else {
			$template["FULL_PATH"] = array(
				array(
					"ID" => "0", 
					"CODE" => "shop", 
					"NAME" => "Главная", 
					"URL" => "/shop/", 
					"IS_LAST" => true
				)
			);
		}


		if(is_numeric($node_id)) {
			$template["CATEGORY_INFO"] = $category_model->GetByID($node_id);
			if($template["CATEGORY_INFO"]["IMAGE"] == "") {
				$template["CATEGORY_INFO"]["IMAGE"] = "placeholder.gif";
			}
			$template["SUB_CATEGORIES"] = $category_model->GetChilds($node_id);
			foreach($template["SUB_CATEGORIES"] as $key => $value) {
				if($template["SUB_CATEGORIES"][$key]["IMAGE"] == "") {
					$template["SUB_CATEGORIES"][$key]["IMAGE"] = "placeholder.gif";
				}
				$template["SUB_CATEGORIES"][$key]["URL"] = "/shop/" .
					implode("/",
						array_map(function($x){return $x["CODE"];},
							$category_model->GetNodePath($value["ID"]))) . "/";
			}
		}

		if($brand == null) {
			if(is_numeric($node_id)) {
				$template["CHILD_BRANDS"] = $manufacturer_model->GetList(array("CATEGORY_ID" => $node_id));
			} else {
				$template["CHILD_BRANDS"] = $manufacturer_model->GetList(array());
			}
		}

		if(isset($_REQUEST['sortby']) && isset($_REQUEST["sort"])) {
			$template["ORDER"] = $param["ORDER"] = array(
				"FIELD" => strtoupper($_REQUEST["sortby"]),
				"VALUE" => strtoupper($_REQUEST["sort"])
			);
		}

		if(isset($_REQUEST["pricemin"])) {
			$price_min = floatval($_REQUEST["pricemin"]);
			$template["PRICE_MIN"] = $param["PRICE_MIN"] = $price_min;
		}

		if(isset($_REQUEST["pricemax"])) {
			$price_max = floatval($_REQUEST["pricemax"]);
			$template["PRICE_MAX"] = $param["PRICE_MAX"] = $price_max;
		}

		$template["ITEM_LIST"] = $product_model->GetListEx($param);

		$param["GET_COUNT"] = "Y";
		$template["ITEM_COUNT"] = $product_model->GetListEx($param);
		if(is_array($template["ITEM_COUNT"])) {
			$template["ITEM_COUNT"] = $template["ITEM_COUNT"][0]["COUNT"];
		}

		if($template["ITEM_COUNT"] > 32) {
			$template["PAGER"] = array(
				"CURRENT" => $page,
				"PAGES" => array()
			);
			$count = intval($template["ITEM_COUNT"]);
			for($i = 0; $i < $count; $i += $param["PAGE_SIZE"]) {
				$template["PAGER"]["PAGES"][$i / 32] = $i / 32;
			}
			unset($template["PAGER"]["PAGES"][$page]);

			$next = array_filter($template["PAGER"]["PAGES"], function($x) use ($page) {
				return $page < $x;
			});
			$prev = array_filter($template["PAGER"]["PAGES"], function($x) use ($page) {
				return $page > $x;
			});
			$template["PAGER"]["NEXT"] = $next;
			$template["PAGER"]["PREV"] = $prev;
		}
		



		return $template;
	}
	$time = microtime(true);
	$template = FillTemplate($DB, $args["CATEGORY_PATH"], $args["PAGE"]);

	// $time = microtime(true) - $time;
	// echo "<pre>";
	// print_r("TIME ON GENERATION: " . $time);
	// //print_r($template);
	// echo "</pre>";

	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";
	
	require($_SERVER["DOCUMENT_ROOT"]."/view/ProductList.php");

	unset($template);
	