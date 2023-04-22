<?php
session_start();
require_once '../core/pro_comment_func.php';
require_once '../../database/conn.php';
require_once '../core/validation.php';
require_once '../core/functions.php';
$errors = [];
if(check_request_method('GET')){
    foreach($_GET as $key => $value){
        $$key = sanitize_input($value);
    }

    if(!is_numeric($comment)){
        $errors['comment'] = 'wrong request';
    }

    
    
    if(empty($errors)){

        delete_comment($conn,$comment);
        $_SESSION['success'] = 'comment has been deleted';
        redirect("../../index.php?page=detail&id=$product_id");

    }else{
        if(isset($id)){
            $_SESSION['errors'] = $errors;
            redirect("../../index.php?page=detail&id=$product_id");
        }
        $_SESSION['errors'] = $errors;
        redirect("../../index.php?page=detail&id=$product_id");
    }
}else{
    $_SESSION['errors']['method'] = 'wrong request method';
    redirect("../../index.php?page=detail&id=$product_id");
}