<?php

require './autoload.php';
$mysql = new MySql();
$mysql->select_db('redbox_auctioneer');
$databaseManager = new DatabaseManager($mysql);
$date = date('Y-m-d H:i:s');
$items = $databaseManager->getItems("WHERE `due_date` > '$date' AND `active` = '1' ORDER BY `due_date` ASC");

require_once 'res/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('template');
$twig = new Twig_Environment($loader);
echo $twig->render('main.html.twig', array('items' => $items));
?>
