<?
	require_once($_SERVER["DOCUMENT_ROOT"]."/system/common.php");

	interface IAction {
		public function Perform($args);
	}

	abstract class AbstractAction implements IAction {
		abstract protected function PrivilegeTokenName();
		public function Perform($args) {
			
		}
		public function IsAllowed($user = null) {
			if($user == null) {
				global $USER;
				$user = $USER;
			}
			if(is_object($user)) {
				return $user->HasRight($this->PrivilegeTokenName());
			}
			return false;
		}
	}



