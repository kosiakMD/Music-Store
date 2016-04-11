<?

	$model = new NewsModel($DB);
	$news_list = $model->GetList(0, 10);
	$template["NEWS_ITEM"] = array();

	foreach ($news_list as $key => $value) {
		$template["NEWS_ITEM"][] = array(
			"CODE" => $value["CODE"],
			"TITLE" => $value["TITLE"],
			"DESCRIPTION" => substr($value["BODY"], 0, 30),
			"DATE" => $value["DATE"]
		);
	}

	require($_SERVER["DOCUMENT_ROOT"]."/view/NewsWidget.php");
	// cleanup the mess
	unset($model);
	unset($news_list);
	unset($template);
