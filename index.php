<?php
include "assets/config.php";
if(isset($_GET['auth'])){ if($_GET['auth'] == $auth) {
    if (isset($_FILES['upload']['name'])) {
        $extension = strtolower(pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION));
        $filename = pathinfo($_FILES['upload']['name'], PATHINFO_FILENAME);

        if (!in_array($extension, $allowed_extensions)) {
            die('{"success":false, "response": "bad extension - ' . $extension . '"}');
        }
        if ($_FILES['upload']['size'] > $max_size) {
            die('{"success":false, "response": "upload too big"}');
        }

        $key = substr(str_shuffle(str_repeat($x = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', ceil($keylength / strlen($x)))), 1, $keylength);
        $name = $key . '.' . $extension;
        $path = $dir ."". $name;
        move_uploaded_file($_FILES['upload']['tmp_name'], $path);
        die('{"success":true, "response": "' . $url . '/upload/' . $name . '"}');

    } else {

        die('{"success":false, "response": "no upload"}');

    }
}}