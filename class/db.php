<?php

$dbhost = 'localhost';
$dbuser = 'user';
$dbpassword = 'password';
try {
	$db = new mysqli($dbhost, $dbuser, $dbpassword);
	$db->query('SET character_set_connection=utf8');
	$db->query('SET character_set_client=utf8');
	$db->query('SET character_set_results=utf8');
} catch (Exception $e) {
	echo $e;
}
?>