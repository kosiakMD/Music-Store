<?

	// .htaccess old rule
	// RewriteRule ^shop/([^\?]*)(/?\?(.*))?$ /shop/index.php?route=shop/$1&$2 [L,QSA]
	require($_SERVER["DOCUMENT_ROOT"] . "/system/common.php");
	require($_SERVER["DOCUMENT_ROOT"]."/components/auth/controller.php");


	$path_mapping = array(
		"#^register.*#" => function($matches) {
			return array(
				"ARGS" => array(),
				"NAME" => "Registration.php",
				"HEADER_META" => array(
					"DESCRIPTION" => "",
					"KEYWORDS" => "",
					"AUTHOR" => ""
				)
			);
		},
		"#^shop/([0-9]+).*$#" => function($matches) {
			$product_id = intval(array_second($matches));
			return array(
				"ARGS" => array(
					"PRODUCT_ID" => $product_id
				),
				"NAME" => "ProductDetail.php",
				"HEADER_META" => array(
					"DESCRIPTION" => "",
					"KEYWORDS" => "",
					"AUTHOR" => ""
				)
			);
		},
		"#^shop/((?!page).+)/(page[0-9]+)+/?$#" => function($matches) {
			$category_path = array_second($matches);
			$page = intval(substr(array_third($matches), 4));
			return array(
				"NAME" => "ProductList.php",
				"ARGS" => array(
					"CATEGORY_PATH" => $category_path,
					"PAGE" => $page
				),
				"HEADER_META" => array(
					"DESCRIPTION" => "",
					"KEYWORDS" => "",
					"AUTHOR" => ""
				)
			);
		},
		"#^shop/((?!page).+)/?$#" => function($matches) {
			$category_path = array_second($matches);
			return array(
				"NAME" => "ProductList.php",
				"ARGS" => array(
					"CATEGORY_PATH" => $category_path,
					"PAGE" => 0
				),
				"HEADER_META" => array(
					"DESCRIPTION" => "",
					"KEYWORDS" => "",
					"AUTHOR" => ""
				)
			);
		},
		"#shop/#" => function($matches) {
			return array(
				"NAME" => "ShopRoot.php",
				"ARGS" => array(),
				"HEADER_META" => array(
					"DESCRIPTION" => "",
					"KEYWORDS" => "",
					"AUTHOR" => ""
				)
			);
		},
		"#^.*$#" => function($matches) {
			return array(
				"NAME" => "ShopRoot.php",
				"ARGS" => array(),
				"HEADER_META" => array(
					"DESCRIPTION" => "",
					"KEYWORDS" => "",
					"AUTHOR" => ""
				)
			);
		}
	);
	
	$path = isset($_REQUEST["route"]) ? $_REQUEST["route"] : "";

	// echo "<pre>";
	// print_r($_REQUEST);
	// echo "</pre>";

	$controller_params = array();
	foreach($path_mapping as $pattern => $result) {
		if(preg_match($pattern, $path, $matches) > 0) {
			$controller_params = $result($matches);
			break;
		}
	}

	$header_meta = $controller_params["HEADER_META"];
	require($_SERVER["DOCUMENT_ROOT"] . "/include/Header.php");
	?>
		<div id="content" class="float_left">
			<div id="container" class="float_left">
				<div id="content_center">
					<div id="article_content" class="borderRadius">
						<?
						$args = $controller_params["ARGS"];
						require($_SERVER["DOCUMENT_ROOT"].'/controller/'.$controller_params['NAME']);
						?>
					</div>
				</div>
			</div>
			<?
			require($_SERVER["DOCUMENT_ROOT"] . "/include/LeftCollumn.php");
			require($_SERVER["DOCUMENT_ROOT"] . "/include/RightCollumn.php");
			?>
		</div>
	<?
	require($_SERVER["DOCUMENT_ROOT"] . "/include/Footer.php");
?>