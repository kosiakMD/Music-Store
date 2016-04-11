<?
	require_once($_SERVER["DOCUMENT_ROOT"]."/action/Register.php");

	echo "<pre>";
	print_r($_REQUEST);
	echo "</pre>";

	if(isset($_REQUEST['action'])) {
		if($_REQUEST['action'] == 'register') {
			if(isset($_REQUEST['password']) && isset($_REQUEST['email']) && isset($_REQUEST['username'])) {
				$error = false;
				$user_model = new UserModel($DB);
				if(!$user_model->IsValidUsername()) {
					PushMessageEx('','REGISTATION_FORM')
				}

				if(!$error) {
					$args = array(
						'USERNAME' => $_REQUEST['username'],
						'PASSWORD' => $_REQUEST['password'],
						'EMAIL' => $_REQUEST['email']
					);
					$user_model->Register();
				}
			}
		} elseif($_REQUEST['action'] == 'activate') {
			if(isset($_REQUEST['token'])) {
				if($user_model->ActivateUser($_REQUEST['token'])) {
					PushMessageEx('SUCCESSFUL_ACTIVATION', 'REGISTATION_FORM');
				} else {
					PushMessageEx('INVALID_ACTIVATION_TOKEN', 'REGISTATION_FORM');
				}
			}
		}
		RedirectEx(GetSelf());
	} 

	

	require($_SERVER['DOCUMENT_ROOT'].'/view/Registration.php');	