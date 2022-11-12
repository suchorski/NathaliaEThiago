<?php

	require_once(__DIR__.'/services/photos.php');
	require_once(__DIR__.'/exceptions/info.php');
	require_once(__DIR__.'/utils/utils.php');
	
	$photo = PhotosService::getById(Utils::parseInt($_GET, 'id', 0), isset($_GET['thumb']));

	header('Content-Type: '.$photo->type);
	header('Content-Disposition: inline; filename="'.$photo->filename.'"');
	header("Cache-Control: max-age=946080000"); // 365 days

	if (isset($_GET['thumb'])) {
		echo base64_decode($photo->thumb);
	} else {
		echo base64_decode($photo->photo);
	}

?>