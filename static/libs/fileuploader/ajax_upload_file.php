<?php
    include('class.fileuploader.php');

	$isAfterEditing = false;
	$fileuploader_title = 'name';
	$fileuploader_replace = false;

	// if after editing
	if (isset($_POST['_namee']) && isset($_POST['fileuploader'])) {
		$fileuploader_title = $_POST['_namee'];
		
		if (isset($_POST['_editingg'])) {
			$fileuploader_replace = true;
			$isAfterEditing = true;
		}
	}
	
	// initialize FileUploader
    $FileUploader = new FileUploader('files', array(
        'limit' => null,
        'maxSize' => null,
		'fileMaxSize' => null,
        'extensions' => null,
        'required' => false,
        'uploadDir' => '../uploads/',
        'title' => $fileuploader_title,
		'replace' => $fileuploader_replace,
        'listInput' => true,
        'files' => null
    ));
	
	// call to upload the files
    $upload = $FileUploader->upload();

	// export to js
	echo json_encode($upload);
	exit;