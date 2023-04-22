<?php
session_start();
require_once "../core/functions.php";
require_once "../core/validation.php";
require_once "../core/order_func.php";
require_once "../../database/conn.php";
$errors = [];

if(check_request_method('GET')){
    $id = sanitize_input($_GET['id']);
    if(require_input($id)){
        $errors['order_id'] = 'wrong request';
    }elseif(!is_numeric($id)){
        $errors['order_id'] = 'wrong request';
    }

    if(empty($errors)){
        reject_order($conn,$id);
        $_SESSION['success'] = 'order rejected successfully';
        redirect("../orders.php");
        die;
    }else{
        $_SESSION['errors'] = $errors;
        redirect("../orders.php");
        die;
    }

}else{
    $_SESSION['errors']['wrong'] = 'wrong request method';
    redirect("../orders.php");
    die;
}