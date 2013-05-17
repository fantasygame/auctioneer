<?php

/**
 * Description of FileManager
 *
 * @author Jakub Kubacki
 */
class FileManager
{

	public function addImage($file)
	{
		return $this->postFile($file);
	}

	private function postFile($postFile)
	{
		if (!preg_match("/image.*/", $postFile['type'])) {
			return false;
		}
		$ext = pathinfo($postFile['name'], PATHINFO_EXTENSION);
		if ($ext == 'bmp') {
			exit('<h1>BMP?</h1><br/><img src="res/img/bmp" />');
		}
		$name = uniqid() . '.' . $ext;
		$file = "res/data/images/$name";

		if (!move_uploaded_file($postFile['tmp_name'], $file)) {
			return false;
		}
		return $name;
	}

}
?>
