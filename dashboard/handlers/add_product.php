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
    }elseif(check_unique_product_name($conn,$name)){
        $errors['name'] = 'product name already exists';
    }

        // description validation

        if(require_input($description)){
            $errors['description'] = 'description is require';
        }elseif(min_len($description,20)){
            $errors['description'] = 'description must be greater than 3 characters';
        }elseif(max_len($description,100)){
            $errors['description'] = 'description must be smaller than 15 characters';
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
        $errors['category'] = 'not a valid category info';
    }

    // image validation

    if(empty($_FILES['image']['name'])){
        $errors['image'] = 'image is require';
    }
    if(empty($errors)){
        $new_image_name = deal_with_image($_FILES['image']);
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

    // insert products

    if(empty($errors)){
        new_product($conn,$name,$description,$category,$brand,$new_image_name,$count,$price);
        $new_product_id = mysqli_insert_id($conn);
        new_product_colors($conn,$new_product_id,$colors);
        $_SESSION['success'] = 'products added successfully';
        redirect('../products.php');
    }else{
        $_SESSION['errors'] = $errors;
        redirect('../add_products.php');
    }

}else{
    $_SESSION['errors']['method'] = 'wrong request method';
    redirect('../add_products.php');
}