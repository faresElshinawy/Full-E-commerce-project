<?php
    session_start();
include_once "../core/validation.php";
include_once "../../database/conn.php"; 
include_once "../core/product_func.php"; 
include_once "../core/functions.php"; 


$id = sanitize_input($_GET['id']);
$color_id = sanitize_input($_GET['color_id']);

delete_product_color($conn , $id , $color_id);
    $_SESSION['success'] = 'color is deleted';
    redirect("../show_product_colors.php?id=$id");
