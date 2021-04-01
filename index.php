<?php
/////////////////////////////////////////////////////////////////
/// getID3() by James Heinrich <info@getid3.org>               //
//  available at https://github.com/JamesHeinrich/getID3       //
//            or https://www.getid3.org                        //
//            or http://getid3.sourceforge.net                 //
//                                                             //
// /demo/demo.simple.php - part of getID3()                    //
// Sample script for scanning a single directory and           //
// displaying a few pieces of information for each file        //
//  see readme.txt for more details                            //
//                                                            ///
/////////////////////////////////////////////////////////////////



require_once('getID/getid3/getid3.php');
set_time_limit(30);

// Initialize getID3 engine
$getID3 = new getID3;

$DirectoryToScan = 'imageFiles'; // change to whatever directory you want to scan
$dir = opendir($DirectoryToScan);
while (($file = readdir($dir)) !== false) {

	$fileType = pathinfo($file, PATHINFO_EXTENSION);
	$FullFileName = realpath($DirectoryToScan.'/'.$file);
	if ((substr($file, 0, 1) == '.') || !is_file($FullFileName)) {
		continue;
	}
	$oldName = $DirectoryToScan.'/'.$file;
	if ($fileType == 'mp4') {
		$ThisFileInfo = $getID3->analyze($FullFileName);
		$getID3->CopyTagsToComments($ThisFileInfo);
		$date =  date('YmdHis', $ThisFileInfo['quicktime']['moov']['subatoms'][0]['creation_time_unix']);
		$newFileName = $DirectoryToScan . '/video/' . $date . '.'. pathinfo($file, PATHINFO_EXTENSION);	
	} 
	if ($fileType == 'jpg' || $fileType == 'png') {
		$img = exif_read_data($FullFileName);		
		$date =  date('YmdHis', $img['FileDateTime']);
		$newFileName = $DirectoryToScan . '/image/' . $date . '.'. pathinfo($file, PATHINFO_EXTENSION);	
	}
	copy($oldName, $newFileName);
}
