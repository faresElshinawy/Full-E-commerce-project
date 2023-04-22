<?php
session_start();
require_once '../../database/conn.php';
require_once '../core/validation.php';
require_once '../core/functions.php';
require_once '../core/product_func.php';
$errors = [];


if(check_request_method('POST')){
    
    // sanitize inputs
    foreach($_POST as $key => $value){
        if($key != 'colors'){
            $$key = sanitize_input($value);
        }
    }

    // name validation

    if(require_input($name)){
        $errors['name'] = 'name is require';
    }elseif(min_len($name,3)){
        $errors['name'] = 'name must be greater than 3 characters';
    }elseif(max_len($name,15)){
        $errors['name'] = 'name must be smaller than 15 characters';
    }elseif(check_unique_product_name_edit($conn,$name,$id)){
        $errors['name'] = 'product name already exists';
    }

        // description validation

        if(require_input($description)){
            $errors['description'] = 'description is require';
        }elseif(min_len($description,20)){
            $errors['description'] = 'description must be greater than 20 characters';
        }elseif(max_len($description,100)){
            $errors['description'] = 'description must be smaller than 100 characters';
        }


    // price validation

    if(require_input($price)){
        $errors['price'] = 'price is require';
    }elseif(numeric($price)){
        $errors['price'] = 'price must be of type number';
    }

        // count validation

        if(require_input($count)){
            $errors['count'] = 'count is require';
        }elseif(numeric($count)){
            $errors['count'] = 'count must be of type number';
        }


    // brand validation

    if(require_input($brand)){
        $errors['brand'] = 'brand is require';
    }elseif(numeric($brand)){
        $errors['brand'] = 'not a valid brand info';
    }

    // category validation

    if(require_input($category)){
        $errors['category'] = 'category is require';
    }elseif(numeric($category)){
        $errors['category'] = 'not a valid category info 3';
    }

    
    // colors validation
    $colors = [];   
    foreach($_POST['colors'] as $key => $value){
        $colors[$key] = sanitize_input($value);
    }
    if(require_input($colors)){
        $errors['colors'] = 'colors is require';
    }
    foreach($colors as $key => $value){
        if(numeric($colors[$key])){
            $errors['colors'] = 'not a valid colors info';
        }
    }

    // image validation

    if(empty($errors)){
    if(!empty($_FILES['image']['name'])){
        $new_image_name = deal_with_image($_FILES['image']);
        if(file_exists("../../uploaded/" . $data['image'])){
            unlink("../../uploaded/" . $old_image);
            }
    }else{
        $new_image_name = $old_image;
    }
    }   

    // insert products

    if(empty($errors)){
        update_product_data($conn,$id,$name,$description,$category,$brand,$new_image_name,$count,$price);
            delete_product_color_on_edit($conn,$id);
        new_product_colors($conn,$id,$colors);
        $_SESSION['success'] = 'products edit is done successfully';
        redirect('../products.php');
    }else{
        $_SESSION['errors'] = $errors;
        redirect("../edit_product.php?id=$id");
    }

}else{
    $_SESSION['errors']['method'] = 'wrong request method';
    redirect("../edit_product.php?id=$id");
}