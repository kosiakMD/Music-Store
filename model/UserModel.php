<?

class User {
	private $m_id;
	private $m_username;

	private $m_firstname;
	private $m_lastname;

	private $m_email;
	private $m_avatar_image;
	private $m_rights;

	private $m_is_authorized;

	public function __construct($fields) {
		if(is_array($fields) && !empty($fields)) {
			$this->m_id = $fields["ID"];
			$this->m_username = $fields["USERNAME"];
			$this->m_email = $fields["EMAIL"];

			$this->m_firstname = $fields["FIRST_NAME"];
			$this->m_lastname = $fields["LAST_NAME"];
			$this->m_avatar_image = $fields["AVATAR_IMAGE"];
			$this->m_rights = $fields["RIGHTS"];
			$this->m_is_authorized = true;
		} else {
			$this->m_is_authorized = false;
		}
	}

	public function IsAuthorized() {
		return $this->m_is_authorized;
	}
	public function HasRight($right_name) {
		if($right_name = "DEFAULT_RIGHT") {
			return true;
		}
		if($this->IsAuthorized()) {
			return in_array($right_name, $this->m_rights);
		} else {
			return false;
		}
	}

	public function GetID() {
		return $this->m_id;
	}

	public function GetFirstName() {
		return $this->m_fristname;
	}

	public function GetLastName() {
		return $this->m_lastname;
	}

	public function GetEmail() {
		return $this->m_email;
	}

	public function GetAvatar() {
		return $this->m_avatar_image;
	}
} 

class UserGroup {
	private $m_id;
	private $m_code;
	private $m_name;
	private $m_rights;
	public function __construct($fields) {
		if(is_array($fields) && !empty($fields)) {
			$m_id = $fields["ID"];
			$m_code = $fields["CODE"];
			$m_name = $fields["NAME"];
			$m_rights = $fields["RIGHTS"];
		}
	}
	public function GetRights() {
		return $this->m_rights;
	}
	public function GetID() {
		return $this->m_id;
	}
	public function GetName() {
		return $this->m_name;
	}
	public function GetCode() {
		return $this->m_code;
	}
}


class GroupModel {
	private $m_db;
	public function __construct($db = null) {
		if($db == null) {
			global $DB;
			$db = $DB;
		}
		$this->m_db = $db;
	}

	public static function GetGroupID($group_code, $db) {
		$query_string = "SELECT id FROM group_info WHERE code = :code";
		$result = QueryEx($query_string, array("CODE" => $group_code), $db);
		if(is_array($result) && !empty($result)) {
			return $result[0]["ID"];
		} else {
			return false;
		}
	}

	public function GetByID($id) {
		$query_string = "SELECT * FROM group_info WHERE id = :id;";
		$result = QueryEx($query_string, array("id" => intval($id)), $this->m_db);
		if(is_array($result) && !empty($result)) {
			$result["RIGHTS"] = $this->GetRights($id);
		}
		return false;
	}

	public function GetRights($id) {
		$query_string = "SELECT priv.* FROM group_privilege AS group_priv 
						 JOIN privilege_info AS priv ON priv.id = group_priv.privilege_id 
						 WHERE group_id = :id;";
		return QueryEx($query_string, array("id" => intval($id)));
	}

	public function AddRight($group_id, $right_id) {
		$query_string = "INSERT INTO group_privilege (group_id, privilege_id) VALUES (:group_id, :privilege_id);";
		return ExecEx($query_string, array(
			"group_id" => intval($group_id),
			"privilege_id" => intval($privilege_id)
		), $this->m_db);
	}

	public function RemoveRight($group_id, $right_id) {
		$query_string = "DELETE FROM group_privilege WHERE group_id = :group_id AND privilege_id = :privilege_id;";
		return ExecEx($query_string, array(
			"group_id" => intval($group_id),
			"privilege_id" => intval($privilege_id)
		), $this->m_db);
	}

	public function GetRightList() {
		$query_string = "SELECT * FROM privilege_info;";
		return QueryEx($query_string, array(), $this->m_db);
	}
}


// this class should be rewriten to exclude Right-related functionality
class UserModel {
	private $m_db;
	public function __construct($db = null) {
		if($db == null) {
			global $DB;
			$db = $DB;
		}
		$this->m_db = $db;
	}

	public function GetCurrentUser() {
		if(isset($_SESSION["AUTH_ID"]) && $_SESSION["AUTH_ID"] != null) {
			$result = $this->GetInfoByID($_SESSION["AUTH_ID"]);
			$result["RIGHTS"] = $this->GetRights($_SESSION["AUTH_ID"]);
			return new User($result);
		}
		return new User(array());
	}

	public function GetByID($id) {
		$result = $this->GetInfoByID($id);
		if(is_array($result) && !empty($result)) {
			$result["RIGHTS"] = $this->GetRights($id);
			return new User($result);
		} else {
			return false;
		}
	}

	public function GetByUsername($username) {
		$result = $this->GetInfoByUsername($username);
		if(is_array($result) && !empty($result)) {
			$result["RIGHTS"] = $this->GetRights($result["ID"]);
		} else {
			return false;
		}
	}

	

	public function GetRights($id) {
		$subresult = $this->GetRightsEx($id);
		$result = array();
		if(is_array($subresult) && !empty($subresult)) {
			
			foreach($subresult as $value) {
				$result[] = $value["CODE"];
			}
		}
		return $result;
	}

	public function GetRightsEx($id) {
		$query_string = "SELECT pinfo.* FROM user_info AS uinfo 
		JOIN group_privilege AS ginfo ON ginfo.group_id = uinfo.group_id
		JOIN privilege_info AS pinfo ON pinfo.id = ginfo.privilege_id
		WHERE uinfo.id = :id;";
		return QueryEx($query_string, array("id" => $id), $this->m_db);
	}

	public function UpdateUserInfo($id, $fields) {
		$query_string = "UPDATE user_info SET ";

		$fields = array_mapex($fields, function($key, $value){
			return array(strtolower($key) => $value);
		});

		// never change id or login of user
		unset($fields["id"]);
		unset($fields["login"]);

		$set_substring = implode(", ", array_mapex($fields, function($key, $value){
			return array($key => "$key = :$key");
		}));
		$query_string .= $set_substring;
		$query_string .= " WHERE id = :id;";
		$fields["id"] = $id;

		return ExecEx($query_string, $fields, $this->m_db);
	}

	public function Register($fields) {
		$errorArray = array();
		if(!is_array($fields)) {
			return false;
		}
		if(!isset($fields["USERNAME"]) || $fields["USERNAME"] == "") {
			$errorArray[] = array(
				"FIELD" => "USERNAME",
				"ERROR" => "EMPTY_USERNAME"
			);
			//return false;
		}
		if(!preg_match("#^[a-zA-Z0-9_]+$#", $fields["USERNAME"])) {
			$errorArray[] = array(
				"FIELD" => "USERNAME",
				"ERROR" => "DISALLOWED_SYMBOLS_IN_USERNAME"
			);
		}
		if(!isset($fields["PASSWORD"]) || $fields["PASSWORD"] == "") {
			$errorArray[] = array(
				"FIELD" => "PASSWORD",
				"ERROR" => "EMPTY_PASSWORD"
			);
			//return false;
		}
		if(!isset($fields["EMAIL"]) || $fields["EMAIL"] == "") {
			$errorArray[] = array(
				"FIELD" => "EMAIL",
				"ERROR" => "EMPTY_EMAIL"
			);
			//return false;
		}
		if($this->GetInfoByUsername($fields["USERNAME"])) {
			$errorArray[] = array(
				"FIELD" => "USERNAME",
				"ERROR" => "USER_ALREADY_EXISTS"
			);
			//return false;
		}

		if(!empty($errorArray)) {
			return $errorArray;
		}



		$fields["PASSWORD_SEED"] = RandomString();
		$fields["PASSWORD"] = md5($fields["PASSWORD"] . $fields["PASSWORD_SEED"]);
		$fields["GROUP_ID"] = GroupModel::GetGroupID("CUSTOMER_GROUP");

		$fields = array_flip($fields);
		foreach($fields as $key => $value) {
			$fields[$key] = strtolower($value);
		}
		$fields = array_flip($fields);

		$var_names = implode(", ", array_keys($fields));
		$var_values = implode(", ", array_map(function($x) {return ":".$x;}, array_keys($fields)));
		
		$query_string = "INSERT INTO user_info ($var_names) VALUES ($var_values);";

		if(ExecEx($query_string, $fields, $this->m_db)) {
			$result = $this->GetInfoByUsername($fields["USERNAME"]);
			$result["RIGHTS"] = $this->GetRights($result["ID"]);
			return new User($result);
		}
		return false;
	}

	public function Login($username, $password) {
		if(isset($_SESSION["AUTH_ID"]) && $_SESSION["AUTH_ID"] != null) {
			return false;
		}
		$query_string = "SELECT password_seed FROM user_info WHERE username = :username;";
		$seed = null;
		$result = QueryEx($query_string, array("username" => $username), $this->m_db);

		if(is_array($result) && !empty($result)) {
			$seed = $result[0]["PASSWORD_SEED"];
			$password = $password . $seed;
			$password = md5($password);
		} else {
			return false;
		}
		$query_string = "SELECT * FROM user_info WHERE username = :username AND password = :password;";
		$result = QueryEx($query_string, array("username" => $username, "password" => $password), $this->m_db);

		if(is_array($result) && !empty($result)) {

			$result = array_head($result);
			$result["RIGHTS"] = $this->GetRights($result["ID"]);
			$this->CreateSession($result["ID"]);
			return new User($result);
		} else {
			return false;
		}
	}

	public function PasswordReminder($email) {
		throw new Exception("NOT IMPLEMENETED YET!");
	}

	public function Logout() {
		if(!isset($_SESSION["AUTH_ID"])) {
			return false;
		}
		$this->DestroySession();
		return true;
	}

	public function IsUsernameUsed($username) {
		$query_string = "SELECT id FROM user_info WHERE username = :username;";
		$query_param = array("username" => $username);
		return count(QueryEx($query_string, $query_param, $this->m_db));
	}

	public function IsValidUsername($username) {
		return preg_match("#^[a-zA-Z0-9_]+$#", $login) == 1;
	}

	public function IsValidEmail($email) {
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	public function IsEmailUsed($email) {
		$query_string = 'SELECT * FROM user_info WHERE email = :email;';
		$query_param = array('email' => $email);
		return count(QueryEx($query_string, $query_param, $this->m_db)) > 0;
	}

	public function IsValidPassword($password) {
		// i don't care
		return true;
	}

	// Implementation related clasess
	protected function CreateSession($id) {
		@session_start();
		$_SESSION["AUTH_ID"] = $id;
		return true;
	}

	protected function DestroySession() {
		@session_start();
		$_SESSION["AUTH_ID"] = false;
		unset($_SESSION["AUTH_ID"]);
		return true;
	}

	protected function GetInfoByID($id) {
		$query_string = "SELECT * FROM user_info WHERE id = :id;";
		$args = array(
			"id" => intval($id)
		);
		$result = QueryEx($query_string, $args, $this->m_db);
		if(!empty($result)) {
			return $result[0];
		}
	}

	protected function GetInfoByUsername($username) {
		$query_string = "SELECT * FROM user_info WHERE username = :username;";
		$args = array(
			"username" => $username
		);
		$result = QueryEx($query_string, $args, $this->m_db);
		if(!empty($result)) {
			return $result[0];
		} else {
			return false;
		}
	}
}