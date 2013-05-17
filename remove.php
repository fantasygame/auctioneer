<?php

if (!isset($_GET['id']) || !isset($_GET['type'])) {
	header('Location: index.php');
	exit;
}
$id = addslashes($_GET['id']);
$type = $_GET['type'];
require './autoload.php';
$mysql = new MySql();
$mysql->select_db('redbox_auctioneer');
$databaseManager = new DatabaseManager($mysql);
if ($type == 'item') {
	$databaseManager->removeItem($id);
} else if ($type == 'offer') {
	$databaseManager->removeOffer($id);
}
header('Location: index.php');
?>
