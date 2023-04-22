<?php
session_start();
require_once '../core/user_func.php';
require_once '../core/validation.php';
require_once '../core/functions.php';
require_once '../../database/conn.php';


$id = sanitize_input($_GET['id']);

$data = user_id_info($conn,$id);
if(file_exists("../../uploaded/" . $data['image'])){
    unlink("../../uploaded/" . $data['image']);
    }
delete_user($conn,$id); 
$_SESSION['success'] = 'user is deleted';
redirect('../users.php');

