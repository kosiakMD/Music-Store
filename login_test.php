<?
	require($_SERVER["DOCUMENT_ROOT"]."/system/common.php");
	echo "<pre>";

	// $user_model = new UserModel($DB);
	
	// print_r($_SESSION);

	// // $user_model->Register(array(
	// // 	"USERNAME" => "petr",
	// // 	"PASSWORD" => "JF*@kfjSk39"
	// // ));

	// // if(!$user_model->Logout()) {
	// // 	echo "Not logged in\n";
	// // }

	// // if($user_model->Login("ivan", "1111")) {
	// // 	echo "Successfull login";
	// // }
	// $USER = $user_model->GetCurrentUser();

	// if($USER->IsAuthorized()) {
	// 	print_r($USER);
	// 	if($USER->HasRight("MANAGER_RIGHT")) {
	// 		echo "Has auth right!";
	// 	}
	// }

	$user_model = new UserModel($DB);
	$cur_url = $_SERVER['PHP_SELF'];

	if(isset($_REQUEST["username"]) && isset($_REQUEST["password"])) {
		$username = strval($_REQUEST["username"]);
		$password = strval($_REQUEST["password"]);
		$result = $user_model->Login($username, $password);
		header('Location: '.$_SERVER['PHP_SELF']);
	} elseif(isset($_REQUEST["logout"]) && $_REQUEST['logout']='yes') {
		$user_model->Logout();
		header('Location: '.$_SERVER['PHP_SELF']);
	}
	// $array = array(
	// 	"first_name" => "ivan",
	// 	"last_name" => "system"
	// );

	// print_r($user_model->UpdateUserInfo(1, $array));

	// print_r($array);

	// print_r(array_mapex($array, function($key, $value) {
	// 	return array($key . "is key" => $value . " was the message;");
	// }));

	print_r($USER);
	// print_r($_SERVER);
	echo "</pre>";

	class MyException extends Exception {

	}

	class AnotherException extends Exception {

	}

	try {
		throw new MyException("Hello world");
	} catch (AnotherException $e) {
		echo "AnotherException: ".$e->GetMessage();
	} catch (MyException $e) {
		echo "MyException: ".$e->GetMessage();
	} catch (Exception $e) {
		echo "Exception: ".$e->GetMessage();
	}
?>
<?if(!$USER->IsAuthorized()):?>
	<form action='' method='get'>
		<label for='username'>Username</label>
		<input type='text' name='username'/>
		<label for='password'>Password</label>
		<input type='password' name='password'/>
		<input type='submit' value='Login'/>
	</form>
<?else:?>
	<form action='' method='get'>
		<input type='hidden' name='logout' value='yes'/>
		<input type='submit' value='Logout'/>
	</form>
<?endif;?>