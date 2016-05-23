<?php

$everbridge_user = "everbridge";
$everbridge_pw = "change me";
$file_location = "alerts.txt";

if (isset($_SERVER['PHP_AUTH_USER']) AND $_SERVER['PHP_AUTH_USER'] == $everbridge_user AND $_SERVER['PHP_AUTH_PW'] == $everbridge_pw) {
	
	$data = json_decode(file_get_contents('php://input'));

	$file = fopen($file_location, "w") or die("Unable to open file!");//overwrite old data
	fwrite($file, $data->title);
	fwrite($file, $data->body);
	fclose($file);
	
	echo "Success";

} else {
	header('WWW-Authenticate: Basic realm="Everbridge Digital Display Endpoint"');
	header('HTTP/1.0 401 Unauthorized');
	echo 'Authentication Failure';
	exit;
}

?>