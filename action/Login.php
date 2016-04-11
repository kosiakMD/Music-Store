<?
	require_once($_SERVER["DOCUMENT_ROOT"]."/action/IAction.php");

	class ActionLogin extends AbstractAction {
		protected function PrivilegeTokenName() {
			return "DEFAULT_RIGHT";
		}

		public function Perform($args) {
			global $USER;

			if(!RequireParams($args, array("USERNAME", "PASSWORD"))) {
				return false;
			}

			if($this->IsAllowed()) {
				if(!$USER->IsAuthorized()) {
					$user_model = new UserModel();
					if($user_model->Login($args['USERNAME'], $args['PASSWORD'])) {
						return true;
					}
				}
			}
			return false;
		}
	}