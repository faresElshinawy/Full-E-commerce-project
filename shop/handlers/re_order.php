<?php 
session_start();
require_once '../core/order_func.php';
require_once '../../database/conn.php';
require_once '../core/validation.php';
require_once '../core/functions.php';

if(check_request_method('GET')){
    foreach($_GET as $key => $value){
        $$key = sanitize_input($value);
    }
    if(!is_numeric($id)){
        $_SESSION['errors']['wrong'] = 'wrong request';
    }

    $user_id = $_SESSION['auth']['id'];
    $address = $_SESSION['auth']['address'];

    if(empty($errors)){
            re_order($conn,$id,$user_id,$address);
            $_SESSION['success'] = 'order submited successfully';
            redirect("../../index.php?page=shop");
    }else{
        $_SESSION['errors']['request'] = 'wronge request';
        redirect("../../index.php?page=order_history");
    }
}else{
    $_SESSION['errors']['method'] = 'wrong request method';
    redirect("../../index.php?page=order_history");
}