<?php
session_start();
require_once '../core/brands_func.php';
require_once '../core/validation.php';
require_once '../core/functions.php';
require_once '../../database/conn.php';


$id = sanitize_input($_GET['id']);

$data = get_brand_by_id($conn,$id);
if(file_exists("../../uploaded/" . $data['brand_image'])){
unlink("../../uploaded/" . $data['brand_image']);
}
delete_brand($conn,$id); 
$_SESSION['success'] = 'brand is deleted';
redirect('../brands.php');
