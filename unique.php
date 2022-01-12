<?php
//专业文件去重
$DirectoryToScan = 'imageFiles'; // change to whatever directory you want to scan
$dir = opendir($DirectoryToScan);
$map = [];
while (($file = readdir($dir)) !== false) {
    $fileType = pathinfo($file, PATHINFO_EXTENSION);
    $FullFileName = realpath($DirectoryToScan . '/' . $file);
    if ((substr($file, 0, 1) == '.') || !is_file($FullFileName)) {
        continue;
    }
    $oldName = $DirectoryToScan . '/' . $file;
    $encrypt = md5_file($oldName);
    $map[$encrypt][] = $oldName;
}

foreach ($map as $val) {
    if (count($val) > 1) {
        echo json_encode($val, JSON_UNESCAPED_UNICODE) . PHP_EOL;
        unlink($val[1]);
    }
}