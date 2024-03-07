<?php

function saveProfilePhoto($file)
{
    $file_path = '../images/profiles/';

    $save_path = $file_path . basename($file['name']);
    move_uploaded_file($file['tmp_name'], $save_path);

    return $save_path;
}
