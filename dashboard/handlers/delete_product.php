<?php
session_start();
require_once '../core/product_func.php';
require_once '../core/validation.php';
require_once '../core/functions.php';
require_once '../../database/conn.php';


$id = sanitize_input($_GET['id']);

$data = get_product_by_id($conn,$id);
if(file_exists("../../uploaded/" . $data['image'])){
unlink("../../uploaded/" . $data['image']);
}
delete_product($conn,$id); 
$_SESSION['success'] = 'product is deleted';
redirect('../products.php');
