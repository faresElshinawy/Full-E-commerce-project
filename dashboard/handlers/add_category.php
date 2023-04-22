<?php
session_start();
require_once '../../database/conn.php';
require_once '../core/validation.php';
require_once '../core/functions.php';
require_once '../core/category_func.php';
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
    }elseif(check_unique_category_name($conn,$name)){
        $errors['name'] = 'category name already exists';
    }

        // description validation

        if(require_input($description)){
            $errors['description'] = 'description is require';
        }elseif(min_len($description,20)){
            $errors['description'] = 'description must be greater than 3 characters';
        }elseif(max_len($description,100)){
            $errors['description'] = 'description must be smaller than 15 characters';
        }





    // image validation

    if(empty($_FILES['image']['name'])){
        $errors['image'] = 'image is require';
    }
    if(empty($errors)){
        $new_image_name = deal_with_image($_FILES['image']);
    }


    // insert category

    if(empty($errors)){
        new_category($conn,$name,$description,$new_image_name);
        $_SESSION['success'] = 'category added successfully';
        redirect('../categories.php');
    }else{
        $_SESSION['errors'] = $errors;
        redirect('../add_categories.php');
    }

}else{
    $_SESSION['errors']['method'] = 'wrong request method';
    redirect('../add_categories.php');
}