<?
	class UserBasket {
		private $m_items;
		private $m_sum;

		public function __construct($fields) {
			$this->m_items = $fields;
			$this->m_sum = 0.0;
			foreach($fields as $value) {
				$this->m_sum += floatval($value["AMOUNT"]) * floatval($value["PRICE"]); 
			}
		}
	}
	
	class BasketModel {
		private $m_db;
		public function __construct($DB) {
			$this->m_db = $DB;
		}

		public function AddEx($fields, $is_authorized) {
			if(RequireFields($fields, "USER_ID", "PRODUCT_ID", "AMOUNT")) {
				if($is_authorized) {
					return Add($fields);
				} else {
					$_SESSION["BASKET_ITEMS"][] = $fields;
					return true;
				}
			}
			return false;
		}
		public function Add($fields) {
			if(RequireFields($fields, "USER_ID", "PRODUCT_ID", "AMOUNT")) {
				$query_string = "INSERT INTO basket (user_id, product_id, amount) VALUES (:USER_ID, :PRODUCT_ID, :AMOUNT);";
				$query_params = $fields;
				return ExecEx($query_string, $query_params, $this->m_db) > 0;
			}
			return false;
		} 
		public function GetList($user_id, $price_id = 1) {
			$query_string = "SELECT bsk.id, bsk.product_id, bsk.amount as amount, prc.value as price FROM basket AS bsk
							 JOIN product_price AS prc ON bsk.product_id = prc.product_id
							 WHERE order_id = -1 AND user_id = :user_id AND prc.price_id = :price_id;";
			$query_params = array(
				"user_id" => $user_id,
				"price_id" => $price_id
			);
			return QueryEx($query_string, $query_params, $this->m_db);
		}
		public function UpdateAmount($id, $amount) {
			$query_string = "UPDATE basket SET amount = :amount WHERE id = :id";
			$query_params = array(
				"id" => $id,
				"amount" => $amount
			);
			return ExecEx($query_string, $query_params, $this->m_db) > 0;
		}
		public function Delete($id) {
			$query_string = "DELETE FROM basket WHERE id = :id";
			$query_params = array(
				"id" => $id
			);
			return ExecEx($query_string, $query_params, $this->m_db);
		}
	}