<?php
	if(!isset($_POST["Access"])) {
		die('Direct access not permitted');
	}
	define('Access', TRUE);
	require_once("pages/function.php");
	$output;
	if (empty($_FILES['images'])) {
		echo json_encode(['error'=>'No files found for upload.']); 
	}
	else{
		$images = $_FILES['images'];
		$id = $_POST["id"];
		
		$ext = explode('.', basename($images['name']));
		$filename = $id . "." . array_pop($ext);
		$target = "img/user/" . $filename;
		if(move_uploaded_file($images['tmp_name'], $target)) {
			$data = Array (
				'foto' => $filename
			);
			$db->where ('id', $id);
			if ($db->update ('user', $data)){
				$output = ['uploaded' => 'Success'];
			}
			else{
				$output = ['error'=>'Error while uploading images. Contact the system administrator'];
			}
		} else {
			$output = ['error'=>'Error while uploading images. Contact the system administrator'];
			unlink($target);
		}
		echo json_encode($output);
	}
	
?>