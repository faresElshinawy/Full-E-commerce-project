<?php
session_start();
require_once '../core/feedback_func.php';
require_once '../../database/conn.php';
require_once '../core/validation.php';
require_once '../core/functions.php';
$errors = [];
if(check_request_method('POST')){
    foreach($_POST as $key => $value){
        $$key = sanitize_input($value);
    }

    if(require_input($message)){
        $errors['message'] = 'message is require';
    }elseif(min_len($message,10)){
        $errors['message'] = 'your message must be greater than or qual 10 characters';
    }elseif(max_len($message,200)){
        $errors['message'] = 'your message must be smaller than or qual 200 characters';
    }

    $user_id = $_SESSION['auth']['id'];
    
    
    if(empty($errors)){

        new_message($conn,$user_id,$message);
        $_SESSION['success'] = 'your message has been sent';
        redirect("../../index.php?page=contact");

    }else{
        if(isset($id)){
            $_SESSION['errors'] = $errors;
            redirect("../../index.php?page=contact");
        }
        $_SESSION['errors'] = $errors;
        redirect("../../index.php?page=contact");
    }
}else{
    $_SESSION['errors']['method'] = 'wrong request method';
    redirect("../../index.php?page=contact");
}