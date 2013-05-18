<?php

require './autoload.php';
$mysql = new MySql();
$mysql->select_db('redbox_auctioneer');
$databaseManager = new DatabaseManager($mysql);

if (isset($_POST['name'])) {
	$r = $_POST;
	$r['id'] = 0;
	$r['client_name'] = '';
	$r['start_date'] = date('Y-m-d H:i:s');
	$r['due_date'] = date('Y-m-d H:i:s', time() + $r['duration'] * 24 * 60 * 60);
	$r['active'] = 1;

	$fileManager = new FileManager();
	$images = array();
	$files = $_FILES;
	for ($i = 0; $i < count($files); $i++) {
		$file = $files[$i];
		if (empty($file['name'])) {
			continue;
		} else {
			$image = $fileManager->addImage($file);
			if (!($image == false)) {
				$images[] = $image;
			}
		}
	}
	$r['images'] = serialize($images);
	$id = $databaseManager->addItem($databaseManager->createItem($r));
	if ($id != false) {
		header('Location: showItem.php?id=' . $id);
	}
}
require_once 'res/lib/Twig/Autoloader.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('template');
$twig = new Twig_Environment($loader);
echo $twig->render('addItem.html.twig', array('clients' => $databaseManager->getClients()));
?>
