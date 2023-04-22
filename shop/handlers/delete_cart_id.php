<?php 
session_start();
require_once '../core/cart_func.php';
require_once '../../database/conn.php';
require_once '../core/validation.php';
require_once '../core/functions.php';

if(check_request_method('GET')){
    foreach($_GET as $key => $value){
        $$key = sanitize_input($value);
    }
    $user_id = $_SESSION['auth']['id'];

    if(empty($errors)){
        $user_order = get_orders_by_id($conn,$user_id,'unconfirmed');
        if($user_order){
            delete_order_item($conn,$user_order['order_id'],$item_id);
            update_pro_count($conn,$id);
            update_order_price($conn,$id,$user_id,$user_order['order_id']);
            $_SESSION['success'] = 'product deleted successfully';
            redirect("../../index.php?page=cart");
            
        }
    }else{
        $_SESSION['errors']['request'] = 'wronge request';
        redirect("../../index.php?page=cart");
    }
}else{
    $_SESSION['errors']['method'] = 'wrong request method';
    redirect("../../index.php?page=cart");
}