<?php 
session_start();
require_once '../core/wishlist_func.php';
require_once '../../database/conn.php';
require_once '../core/validation.php';
require_once '../core/functions.php';
$errors = [];
if(check_request_method('GET')){
    foreach($_GET as $key => $value){
        $$key = sanitize_input($value);
    }
    if(require_input($id)){
        $errors['product'] = 'wrong add request';
    }
    $user_id = $_SESSION['auth']['id'];
    
    
    if(empty($errors)){
        remove_wishlist_item($conn,$id);
        $_SESSION['success'] = 'item deleted successfully';
        redirect("../../index.php?page=wishlist");
    }else{
        $_SESSION['errors'] = $errors;
        redirect("../../index.php?page=wishlist");
    }
}else{
    $_SESSION['errors']['method'] = 'wrong request method';
    redirect("../../index.php?page=shop");
}