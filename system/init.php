<?
	function GetCurrentUser() {
		global $DB;
		$user_model = new UserModel($DB);
		return $user_model->GetCurrentUser();
	}

	$USER = GetCurrentUser();