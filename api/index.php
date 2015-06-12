<?php
include('connection.php');

$action = $_GET['action'];

switch($action){
	case "register":
		register();
	break;
	case "login":
		login();
	break;
	case "lostPassword":
		lostPasswordEmail();
	break;
	case "passwordLink":
		passwordLink();
	break;
	case "lostPassword2":
		passwordReset();
	break;
}

function register(){
	
	$username = $_GET['username'];
	$password = $_GET['password'];
	$email = $_GET['email'];
	$dorm = $_GET['dorm'];
	$key = $_GET['key'];
	
	$sql = "SELECT * FROM  `Account` WHERE `Account_email` = '$email'";
	$query = mysql_query($sql);
	$rows = mysql_fetch_array($query);
	
	if($rows > 0){
		header('HTTP/1.1 500 Internal Server Booboo');
        header('Content-Type: application/json; charset=UTF-8');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
	}
	$sql = "INSERT INTO  `rubendem-4`.`Account` (`Account_id` ,`Role_Role_Id` ,`Account_username` ,`Account_password` ,`Account_email` ,`Account_verify` ,`Account_key`,`Dorm_Dorm_id`)VALUES (NULL ,  '2',  '$username', MD5(  '$password' ) ,  '$email',  'false',  '$key','$dorm');";
	
	if(mysql_query($sql)){
		$response_array['status'] = 'success';
		header('content-type: application/json;');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        print json_encode($response_array);
	}else{
		header('HTTP/1.1 500 Internal Server Booboo');
        header('Content-Type: application/json; charset=UTF-8');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
	}
}

function login(){
	$username = $_GET['username'];
	$password = $_GET['password'];
	$sql = "SELECT * FROM  `Account` WHERE `Account_username` = '$username'";
	$query = mysql_query($sql);
	$rows = mysql_fetch_array($query);
	
	if($rows['Account_password'] == md5($password) && $rows['Account_verify'] == "true" ){
		$response_array['status'] = 'success';
		$response_array['id'] = $rows['Account_id'];
		header('content-type: application/json;');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        print json_encode($response_array);
	}else{
		header('HTTP/1.1 500 Internal Server Booboo');
        header('Content-Type: application/json; charset=UTF-8');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        die(json_encode(array('message' => 'ERROR', 'code' => 1337)));	
	}
}

function lostPasswordEmail(){
	$email = $_GET['email'];
	
	$sql = "SELECT * FROM  `Account` WHERE `Account_email` = '$email'";
	$query = mysql_query($sql);
	$rows = mysql_fetch_array($query);
	
	$key = $rows['Account_key'];
	
	// multiple recipients
	$to  = $email;
		
	// subject
	$subject = 'Lost password link';
	
	// message
	$message = '<p>Vul onderstaande code in de app in om uw wachtwoord te wijzigen</p><strong>'.$key.'</strong>';
	
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	// Mail it
	$send = mail($to, $subject, $message, $headers);
	
	if($send){
		$response_array['status'] = 'success';
		header('content-type: application/json;');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        print json_encode($response_array);
	}else{
		header('HTTP/1.1 500 Internal Server Booboo');
        header('Content-Type: application/json; charset=UTF-8');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
	}
}

function passwordReset(){
	$email = $_GET['email'];
	$code = $_GET['code'];
	$new_password = $_GET['new_password'];
	$sql = "SELECT * FROM  `Account` WHERE `Account_email` = '$email' AND `Account_key` = '$code'";
	$query = mysql_query($sql);
	$rows = mysql_num_rows($query);
	
	if($rows > 0){
		$sql = "UPDATE  `rubendem-4`.`Account` SET  `Account_password` = MD5(  '$new_password' ) WHERE  `Account`.`Account_email` = '$email';";
		if(mysql_query($sql)){
			$response_array['status'] = 'success';
			$response_array['id'] = $rows['Account_id'];
			header('content-type: application/json;');
			header('Access-Control-Allow-Origin: *');
			header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
			print json_encode($response_array);
		}else{
		header('HTTP/1.1 500 Internal Server Booboo');
        header('Content-Type: application/json; charset=UTF-8');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        die(json_encode(array('message' => 'ERROR', 'code' => 1337)));	
		}
	}else{
		header('HTTP/1.1 500 Internal Server Booboo');
        header('Content-Type: application/json; charset=UTF-8');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        die(json_encode(array('message' => 'ERROR', 'code' => 1337)));	
	}
}

?>