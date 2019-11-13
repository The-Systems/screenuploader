<?php
include "assets/config.php";

$filename = pathinfo($_FILES['upload']['name'], PATHINFO_FILENAME);

$extension = strtolower($filename);
if(!in_array($extension, $allowed_extensions)) {
    die('{"success":false, "response": "bad extension"}');
}

if($_FILES['upload']['size'] > $max_size) {
    die('{"success":false, "response": "upload too big"}');
}

$key = substr(str_shuffle(str_repeat($x='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', ceil($keylength/strlen($x)) )),1,$keylength);
$name = $key.'.'.$extension;
$path = "upload/".$name;
move_uploaded_file($_FILES['upload']['tmp_name'], $path);
die('{"success":true, "response": "'.$url.'/'.$name.'"}');

