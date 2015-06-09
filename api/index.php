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
}

function register(){
	$username = $_GET['username'];
	$password = $_GET['password'];
	$email = $_GET['email'];
	$dorm = $_GET['dorm'];
	$key = $_GET['key'];
	
	$sql = "INSERT INTO  `rubendem-4`.`Account` (`Account_id` ,`Role_Role_Id` ,`Account_username` ,`Account_password` ,`Account_email` ,`Account_verify` ,`Account_key`,`dorm_id`)VALUES (NULL ,  '3',  '$username', MD5(  '$password' ) ,  '$email',  'false',  '$key','$dorm');";
	
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
	
	if($rows['Account_password'] == md5($password)){
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

?>