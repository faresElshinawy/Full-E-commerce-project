<?php
    session_start();
include_once "../core/validation.php";
include_once "../../database/conn.php"; 
include_once "../core/color_func.php"; 
include_once "../core/functions.php"; 


$id = sanitize_input($_GET['id']);

delete_color($conn,$id);
$_SESSION['success'] = 'color is deleted';
redirect("../colors.php");