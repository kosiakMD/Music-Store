<?
	require_once($_SERVER["DOCUMENT_ROOT"]."/action/Login.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/action/Logout.php");

	$template = array();
	if(isset($_REQUEST['action']) && $_REQUEST["action"] == "logout") {
		$action = new ActionLogout();
		if($action->Perform(array())) {
			PushMessageEx("Successful logout", "COMPONENT_AUTH");
		} else {
			PushMessageEx("Unsuccessful logout", "COMPONENT_AUTH");
		}
		RedirectEx(GetSelf());
	} elseif(isset($_REQUEST["action"]) 	 && 
			 $_REQUEST["action"] == "login"  &&
			 isset($_REQUEST["username"])	 && 
			 isset($_REQUEST["password"])) {
		$action = new ActionLogin();
		$result = $action->Perform(array(
			"USERNAME" => $_REQUEST["username"],
			"PASSWORD" => $_REQUEST["password"]
		));
		if($result == true) {
			PushMessageEx("Successful login", "COMPONENT_AUTH");
		} else {
			PushMessageEx("Unsucessful login", "COMPONENT_AUTH");
		}
		RedirectEx(GetSelf());
	}
	if($USER->IsAuthorized()) {
		$template["STATE"] = "AUTHORIZED";
	} else {
		$template["STATE"] = "UNAUTHORIZED";
	}

	$template["MESSAGES"] = PopMessagesEx("COMPONENT_AUTH");
	require("view.php");