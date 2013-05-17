<?php
if(!isset($_GET['id'])) {
	header('Location: index.php');
	exit;
}
$id = addslashes($_GET['id']);
require './autoload.php';
$mysql = new MySql();
$mysql->select_db('redbox_auctioneer');
$databaseManager = new DatabaseManager($mysql);
$item = $databaseManager->getItems("WHERE i.id = '$id'");
$item = $item[0];
$clients = $databaseManager->getClients();

require_once 'res/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('template');
$twig = new Twig_Environment($loader);
echo $twig->render('item.html.twig', array('item' => $item, 'clients' => $clients));
?>
