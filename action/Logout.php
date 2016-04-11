<?
	require_once($_SERVER["DOCUMENT_ROOT"]."/action/IAction.php");

	class ActionLogout extends AbstractAction {
		protected function PrivilegeTokenName() {
			return "AUTH_RIGHT";
		}

		public function Perform($args) {
			global $USER;

			if(!RequireParams($args, array())) {
				return false;
			}

			if($this->IsAllowed()) {
				if($USER->IsAuthorized()) {
					$user_model = new UserModel();
					if($user_model->Logout()) {
						return true;
					}
				}
			}
			return false;
		}
	}