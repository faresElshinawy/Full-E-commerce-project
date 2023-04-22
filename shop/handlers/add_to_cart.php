<?php 
session_start();
require_once '../core/order_func.php';
require_once '../core/wishlist_func.php';
require_once '../../database/conn.php';
require_once '../core/validation.php';
require_once '../core/functions.php';
$errors = [];
if(check_request_method('POST')){
    foreach($_POST as $key => $value){
        $$key = sanitize_input($value);
    }
    if(require_input($color)){
        $errors['color'] = 'you need to choose a color';
    }
    if(require_input($id)){
        $errors['product'] = 'wrong add request';
    }
    $user_id = $_SESSION['auth']['id'];
    $address = $_SESSION['auth']['address'];
    
    
    if(empty($errors)){
        $user_order = get_orders_by_id($conn,$user_id,'unconfirmed');
        if($user_order){
            new_order_item($conn,$user_order['order_id'],$id,$color);
            update_pro_count($conn,$id);
            update_order_price($conn,$id,$user_id,$user_order['order_id']);
            if(isset($item_id)){
                remove_wishlist_item($conn,$item_id);
            }
            $_SESSION['success'] = 'product added successfully';
            redirect("../../index.php?page=shop");

        }elseif(empty($user_order)){

            $order_id = new_order($conn,$user_id,$address);
            new_order_item($conn,$order_id,$id,$color);
            update_pro_count($conn,$id);
            update_order_price($conn,$id,$user_id,$order_id);
            if(isset($item_id)){
                remove_wishlist_item($conn,$item_id);
            }
            $_SESSION['success'] = 'product added successfully';
            redirect("../../index.php?page=shop");
            
        }
    }else{
        if(isset($id)){
            $_SESSION['errors'] = $errors;
            redirect("../../index.php?page=detail&id=$id");
            die;
        }
        $_SESSION['errors'] = $errors;
        redirect("../../index.php?page=shop");
    }
}else{
    $_SESSION['errors']['method'] = 'wrong request method';
    redirect("../../index.php?page=shop");
}
