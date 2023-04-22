<?php
    session_start();
include_once "../core/validation.php";
include_once "../../database/conn.php"; 
include_once "../core/order_func.php"; 
include_once "../core/functions.php"; 


$id = sanitize_input($_GET['id']);

delete_order($conn,$id);
$_SESSION['success'] = 'order is deleted';
redirect("../orders.php");