<?php
session_start();
require_once '../../database/conn.php';
require_once '../core/validation.php';
require_once '../core/functions.php';
require_once '../core/brands_func.php';
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
    }elseif(check_unique_brand_name_edit($conn,$name,$id)){
        $errors['name'] = 'brand name already exists';
    }

        // description validation

        if(require_input($description)){
            $errors['description'] = 'description is require';
        }elseif(min_len($description,20)){
            $errors['description'] = 'description must be greater than 20 characters';
        }elseif(max_len($description,100)){
            $errors['description'] = 'description must be smaller than 100 characters';
        }





    // image validation

    if(empty($errors)){
        if(!empty($_FILES['image']['name'])){
            $data = get_brand_by_id($conn,$id);
            $new_image_name = deal_with_image($_FILES['image']);
            if(file_exists("../../uploaded/" . $data['brand_image'])){
                unlink("../../uploaded/" . $old_image);
                }
        }else{
            $new_image_name = $old_image;
        }
    }   


    // insert brand

    if(empty($errors)){
        update_brand($conn,$id,$name,$description,$new_image_name);
        $_SESSION['success'] = 'brand added successfully';
        redirect('../brands.php');
    }else{
        $_SESSION['errors'] = $errors;
        redirect("../edit_brands.php?id=$id");
    }

}else{
    $_SESSION['errors']['method'] = 'wrong request method';
    redirect("../edit_brands.php?id=$id");
}