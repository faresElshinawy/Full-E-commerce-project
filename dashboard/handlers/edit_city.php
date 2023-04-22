<?php
session_start();
require_once '../../database/conn.php';
require_once '../core/validation.php';
require_once '../core/functions.php';
require_once '../core/location_func.php';
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
    }elseif(check_unique_city_name_edit($conn,$name,$id)){
        $errors['name'] = 'city name already exists';
    }


    // insert city

    if(empty($errors)){
        update_city($conn,$name,$id);
        $_SESSION['success'] = 'city added successfully';
        redirect('../locations.php');
    }else{
        $_SESSION['errors'] = $errors;
        redirect("../edit_city.phpid=$id");
    }

}else{
    $_SESSION['errors']['method'] = 'wrong request method';
    redirect("../edit_city.phpid=$id");
}