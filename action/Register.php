<?
	require_once($_SERVER["DOCUMENT_ROOT"]."/action/IAction.php");

	class ActionRegister extends AbstractAction {
		protected function PrivilegeTokenName() {
			return "DEFAULT_RIGHT";
		}

		public function Perform($args) {
			global $USER;

			if(!RequireParams($args, array("USERNAME", "EMAIL", "PASSWORD"))) {
				return false;
			}

			if($this->IsAllowed()) {
				if(!$USER->IsAuthorized()) {
					global $DB;
					$user_model = new UserModel($DB);
					$result = $user_model->Register($args);
					if(!is_object($result)) {
						return $result;
					}
				}
			}
			return false;
		}
	}