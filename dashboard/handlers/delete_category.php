<?php
session_start();
require_once '../core/category_func.php';
require_once '../core/validation.php';
require_once '../core/functions.php';
require_once '../../database/conn.php';


$id = sanitize_input($_GET['id']);

$data = get_category_by_id($conn,$id);
if(file_exists("../../uploaded/" . $data['cat_image'])){
unlink("../../uploaded/" . $data['cat_image']);
}
delete_category($conn,$id); 
$_SESSION['success'] = 'category is deleted';
redirect('../categories.php');
