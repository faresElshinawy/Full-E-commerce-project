<?php
    session_start();
include_once "../core/validation.php";
include_once "../../database/conn.php"; 
include_once "../core/location_func.php"; 
include_once "../core/functions.php"; 


$id = sanitize_input($_GET['id']);

delete_city($conn,$id);
$_SESSION['success'] = 'city is deleted';
redirect("../locations.php");