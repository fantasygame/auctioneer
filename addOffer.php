<?php

if (isset($_POST['description'])) {
	require './autoload.php';
	$mysql = new MySql();
	$mysql->select_db('redbox_auctioneer');
	$databaseManager = new DatabaseManager($mysql);
	$r = $_POST;
	$r['id'] = 0;
	$r['client_name'] = '';
	$r['accepted'] = 1;
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
	$databaseManager->addOffer($databaseManager->createOffer($r));
	$id = $r['item_id'];
	header('Location: showItem.php?id=' . $id);
} else {
	header('Location: index.php');
}
?>
