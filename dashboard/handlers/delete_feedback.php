<?php
    session_start();
include_once "../core/validation.php";
include_once "../../database/conn.php"; 
include_once "../core/feedback_func.php"; 
include_once "../core/functions.php"; 


$id = sanitize_input($_GET['id']);

delete_feedback($conn,$id);
$_SESSION['success'] = 'feedback is deleted';
redirect("../feedbacks.php");