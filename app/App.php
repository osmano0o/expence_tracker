<?php

declare(strict_types = 1);
$files = scandir(FILES_PATH);
$array = [];
for($count = count($files),$i = 2; $i < $count ; $i++ ){
    $get = file_get_contents(FILES_PATH . $files[$i]);
    array_push($array,explode("\n",$get));
};