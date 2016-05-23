<?php

$mysql_host = '';
$mysql_user = '';
$mysql_pw = '';
$mysql_db = '';

$everbridge_user = "everbridge";
$everbridge_pw = "";

$show_for_minutes = 15;


$dbsqli = new mysqli($mysql_host, $mysql_user, $mysql_pw, $mysql_db);

if (isset($_SERVER['PHP_AUTH_USER']) AND $_SERVER['PHP_AUTH_USER'] == $everbridge_user AND $_SERVER['PHP_AUTH_PW'] == $everbridge_pw) {
	//save to DB
	$data = json_decode(file_get_contents('php://input'));

	if ($dbsqli->query("INSERT INTO `alerts` (`title`, `body`, `received_user`, `received_at`, `expire_at`) VALUES (
		'".mysqli_real_escape_string($dbsqli,$data->title)."',
		'".mysqli_real_escape_string($dbsqli,$data->body)."',
		'".mysqli_real_escape_string($dbsqli,$_SERVER['PHP_AUTH_USER'])."',
		NOW(),
		DATE_ADD(NOW(), INTERVAL {$show_for_minutes} MINUTE));")) {
		echo "Success";
	}else{
		echo "Fail";
	}
} else {
	header('WWW-Authenticate: Basic realm="Everbridge Digital Display Endpoint"');
	header('HTTP/1.0 401 Unauthorized');
	echo 'Authentication Failure';
	exit;
}

?>