<?
	require_once($_SERVER["DOCUMENT_ROOT"]."/action/IAction.php");

	class ActionAddBasketItem extends AbstractAction {
		protected function PrivilegeTokenName() {
			return "DEFAULT_RIGHT";
		}

		public function Perform($args) {
			global $USER;

			if(!RequireParams($args, array("PRODUCT_ID", "USER_ID", "AMOUNT"))) {
				return false;
			}

			if($this->IsAllowed()) {
				if(!$USER->IsAuthorized()) {
					global $DB;
					$basket_model = new BasketModel($DB);
					return $basket_model->Add($args);
				}
			}
			return false;
		}
	}