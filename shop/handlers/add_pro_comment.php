<?php
session_start();
require_once '../core/pro_comment_func.php';
require_once '../../database/conn.php';
require_once '../core/validation.php';
require_once '../core/functions.php';
$errors = [];
if(check_request_method('POST')){
    foreach($_POST as $key => $value){
        $$key = sanitize_input($value);
    }

    if(require_input($comment)){
        $errors['comment'] = 'you cant send an empty comment';
    }elseif(max_len($comment,200)){
        $errors['comment'] = 'your comment must be smaller than or qual 200 characters';
    }

    $user_id = $_SESSION['auth']['id'];
    
    
    if(empty($errors)){

        new_pro_comment($conn,$user_id,$product_id,$comment);
        $_SESSION['success'] = 'your comment has been sent';
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