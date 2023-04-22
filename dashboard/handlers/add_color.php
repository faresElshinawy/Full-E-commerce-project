<?php
session_start();
require_once '../../database/conn.php';
require_once '../core/validation.php';
require_once '../core/functions.php';
require_once '../core/color_func.php';
$errors = [];


if(check_request_method('POST')){
    
    // sanitize inputs
    foreach($_POST as $key => $value){
        $$key = sanitize_input($value);
    }

    // name validation

    if(require_input($name)){
        $errors['name'] = 'name is require';
    }elseif(min_len($name,3)){
        $errors['name'] = 'name must be greater than 3 characters';
    }elseif(max_len($name,15)){
        $errors['name'] = 'name must be smaller than 15 characters';
    }elseif(check_unique_color_name($conn,$name)){
        $errors['name'] = 'color name already exists';
    }


    // insert city

    if(empty($errors)){
        new_color($conn,$name);
        $_SESSION['success'] = 'color added successfully';
        redirect('../colors.php');
    }else{
        $_SESSION['errors'] = $errors;
        redirect('../add_colors.php');
    }

}else{
    $_SESSION['errors']['method'] = 'wrong request method';
    redirect('../add_colors.php');
}