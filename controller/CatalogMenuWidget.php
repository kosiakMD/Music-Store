<?
	

	function RenderTree($tree, $baseurl) {
		echo "<li>";
		echo "<a href='$baseurl/$tree[CODE]/'>$tree[NAME]</a>";
		if(is_array($tree["CHILD"]) && !empty($tree["CHILD"])) {
			echo "<div class='ul_container'>";
			echo "<ul class='drop'>";
			foreach($tree["CHILD"] as $child_tree) {
				RenderTree($child_tree, $baseurl."/".$tree["CODE"]);
			}
			echo "</ul>";
			echo "</div>";
		}
		echo "</li>";
	}

	// load data
	$treemodel = new CategoryTreeModel($DB);

	// store it in the template
	$template["CATEGORY_TREE"] = $treemodel->GetTree();

	// dispose of object
	$treemodel = null;

	require($_SERVER["DOCUMENT_ROOT"]."/view/CatalogMenuWidget.php");
	unset($template);
?>