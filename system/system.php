<?
	function QueryEx($query, $params, $dbo = null) {
		if($dbo == null) {
			$dbo = $GLOBALS["DB"];
		}
		$statement = $dbo->prepare($query);

		$result = $statement->execute($params);

		if(!$result) {
			return false;
		} else {
			$result = $statement->FetchAll();
		}

		$result_array = array();
		foreach($result as $value) {
			$temp = array();
			foreach($value as $attr_key => $attr_value) {
				if(!is_numeric($attr_key)) {
					$temp[strtoupper($attr_key)] = $attr_value;
				}
			}
			$result_array[] = $temp;
		}
		if(empty($result_array)) {
			return false;
		} else {
			return $result_array;
		}
	}

	function ExecEx($query, $params, $dbo = null) {
		if($dbo == null) {
			$dbo = $GLOBALS["DB"];
		}

		$statement = $dbo->prepare($query);
		$result = $statement->execute($params);

		if($result) {
			return $statement->rowCount();
		} else {
			return false;
		}
	}

	function GetPath() {
		// yeah sure, we don't need that nifty mod_rewrite rule to parse url...retard
		//$result = array_values(array_filter(explode("/", $_SERVER["REQUEST_URI"])));
		if(isset($_REQUEST["route"])) {
			$result = array_filter(explode("/", $_REQUEST["route"]));
			foreach($result as $key => $value) {
				$result[$key] = mysql_real_escape_string($value);
			}
		} else {
			$result = array("shop");
		}
		return $result;
	}

	function array_head($array) {
		$head = array_shift($array);
		return $head;
	}

	function array_tail($array) {
		array_shift($array);
		return $array;
	}

	function array_cons($head, $tail) {
		array_unshift($tail, $head);
		return $tail;
	}

	function array_quote() {
		return func_get_args();
	}

	function array_mapex_($array, $function) {
		array_walk($array, $function);
		return $array;
	}

	function array_mapex($array, $function) {
		$new_array = array();
		foreach($array as $key => $value) {
			$result = $function($key, $value);

			$key = array_head(array_keys($result));
			$value = array_head(array_values($result));

			$new_array[$key] = $value;
		}
		return $new_array;
	}

	function RandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}

	function SendEmail($to, $from, $subject, $message) {
		if(is_array($to)) {
			$to = implode(", ", $to);
		}

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

		$headers .= "To: $to" . "\r\n";
		$headers .= "From: $from" . "\r\n";
		try {
			mail($to, $subject, $message, $headers);
		} catch(Exception $e) {
			return false;
		}
		return true;
	}

	function RequireParams($array, $array_params) {
		foreach($array_params as $param) {
			if(!isset($array[$param])) {
				return false;
			}
		}
		return true;
	}

	function PushMessage($message) {
		$_SESSION["MESSAGES"][] = $message;
	}

	function PushMessageEx($message, $source) {
		$_SESSION["MESSAGES"][] = array(
			"SOURCE" => $source,
			"MESSAGE" => $message
		);
	}

	function PopMessages() {
		if(isset($_SESSION["MESSAGES"])) {
			$messages = $_SESSION["MESSAGES"];
			unset($_SESSION["MESSAGES"]);
			return $messages;
		}
		return array();
	}

	function PopMessagesEx($source) {
		$messages = array();
		if(isset($_SESSION["MESSAGES"])) {
			foreach($_SESSION["MESSAGES"] as $key => $value) {
				if($value["SOURCE"] == $source) {
					$messages[] = $value;
					unset($_SESSION["MESSAGES"][$key]);
				}
			}
			if(empty($_SESSION["MESSAGES"])) {
				unset($_SESSION["MESSAGES"]);
			}
		}
		return $messages;
	}

	function GetSelf() {
		if(isset($_SERVER["REDIRECT_URL"])) {
			return $_SERVER["REDIRECT_URL"];
		} else {
			return $_SERVER["PHP_SELF"];
		}
	}

	function Redirect($url) {
		header('Location: '.$url);
		exit;
	}

	function RedirectEx($url) {
		Redirect($url);
		die();
	}

	function array_first($array) {
		if(isset($array[0])) {
			return $array[0];
		} else {
			return null;
		}
	}

	function array_second($array) {
		if(isset($array[1])) {
			return $array[1];
		} else {
			return null;
		}
	}

	function array_third($array) {
		if(isset($array[2])) {
			return $array[2];
		} else {
			return null;
		}
	}

	require_once($_SERVER["DOCUMENT_ROOT"]."/model/NewsModel.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/model/CategoryTreeModel.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/model/ProductModel.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/model/ManufacturerModel.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/model/UserModel.php");
	require_once($_SERVER["DOCUMENT_ROOT"]."/model/BasketModel.php");