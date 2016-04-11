<?
	$product_id = $args["PRODUCT_ID"];
	$price_id = 1;

	$model = new ProductModel($DB);
	$product_info = $model->GetByID($product_id);
	$price_info = $model->GetPrices($product_id);
	$filter_info = $model->GetFilterValues($product_id);
	$category_model = new CategoryTreeModel($DB);

	$product_info["CATEGORY_ID"] = $model->GetCategoryID($product_id);

	$model_manf = new ManufacturerModel($DB);
	$manuf_info = $model_manf->GetByID($product_info["ID"]);

	$template = array();

	if($product_info["IMAGE_NAME"] == "") {
		$product_info["IMAGE_NAME"] = "placeholder.gif";
	}

	$template["PRODUCT_NAME"] = $product_info["NAME"];
	$template["PRODUCT_IMAGE_URL"] = "/images/$product_info[IMAGE_NAME]";
	$template["RATING_VALUE"] = $product_info["RATING"]["AVERAGE"];
	$template["RATING_COUNT"] = $product_info["RATING"]["COUNT"];
	$template["STORE_COUNT"] = $model->GetStoreCount($product_id);
	$template["PRICE_FORMATED"] = $price_info[1]["VALUE"];
	$template["PRODUCT_DESCRIPTION"] = $product_info["DESCRIPTION"];
	$template["MANUFACTURER_DESCRIPTION"] = $manuf_info["DESCRIPTION"];

	$template["FULL_PATH"] = $category_model->GetNodePath($product_info["CATEGORY_ID"]);

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

	if(isset($_SESSION["RECENTLY_VIEWED"])) {
		$template["RECENTLY_VIEWED"]["ID_LIST"] = array_filter($_SESSION["RECENTLY_VIEWED"], 
		function($x) use ($product_id) {
			return $x != $product_id;
		});

		foreach($template["RECENTLY_VIEWED"]["ID_LIST"] as $value_id) {
			$temp = $model->GetByID($value_id);
			$temp_price = $model->GetPrices($value_id);

			if($temp["IMAGE_NAME"] == "") {
				$temp["IMAGE_NAME"] = "placeholder.gif";
			}

			$template["RECENTLY_VIEWED"][] = array(
				"PRODUCT_ID" => $value_id,
				"PRODUCT_NAME" => $temp["NAME"],
				"PRODUCT_DESCRIPTION" => $temp["DESCRIPTION"],
				"PRICE_FORMATED" => $temp_price[$price_id]["VALUE"],
				"PRODUCT_IMAGE_URL" => "/images/$temp[IMAGE_NAME]"
			);
		}
		unset($template["RECENTLY_VIEWED"]["ID_LIST"]);
	}

	require_once($_SERVER["DOCUMENT_ROOT"]."/view/ProductDetail.php");

	$_SESSION["RECENTLY_VIEWED"][] = $product_id;

	// Yo dawg we herd u like LISP so we put LISP in your PHP so you can eval while you eval
	$_SESSION["RECENTLY_VIEWED"] = 
	array_slice(
		array_reverse(
			array_values(
				array_unique($_SESSION["RECENTLY_VIEWED"]))), 0, 3);

	unset($category_model);
	unset($price_id);
	unset($product_info);
	unset($price_info);
	unset($filter_info);
	unset($model);
	unset($template);

