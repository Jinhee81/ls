<?php
// default redirection
$url = $_REQUEST["callback"].'?callback_func='.$_REQUEST["callback_func"];
$bSuccessUpload = is_uploaded_file($_FILES['Filedata']['tmp_name']);

// SUCCESSFUL
if(bSuccessUpload) {
	$wdate=time();
	$tmp_name = $_FILES['Filedata']['tmp_name'];
	$name = $_FILES['Filedata']['name'];
	
	$filename_ext = strtolower(array_pop(explode('.',$name)));
	$allow_file = array("jpg", "png", "bmp", "gif");
	
	if(!in_array($filename_ext, $allow_file)) {
		$url .= '&errstr='.$name;
	} else {
		$uploadDir = '../../../data/editor/';
		if(!is_dir($uploadDir)){
			mkdir($uploadDir, 0777);
		}
		
		$newPath = $uploadDir.urlencode($wdate."_".$_FILES['Filedata']['name']);
		$save_url =$wdate."_".$name;
		@move_uploaded_file($tmp_name, $newPath);
		
		$url .= "&bNewLine=true";
		$url .= "&sFileName=".urlencode(urlencode($name));
		$url .= "&sFileURL=/data/editor/".urlencode(urlencode($save_url));
	}
}
// FAILED
else {
	$url .= '&errstr=error';
}
	
header('Location: '. $url);
?>