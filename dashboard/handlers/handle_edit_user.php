<?php
session_start();
require_once '../../database/conn.php';
require_once '../core/user_func.php';
require_once '../core/validation.php';
require_once '../core/functions.php';
$errors = [];

if(check_request_method('POST')){
    
    // sanitize inputs
    foreach($_POST as $key => $value){
        $$key = sanitize_input($value);
    }
    $id = $_SESSION['auth']['id'];
    // name validation

    if(require_input($firstname)){
        $errors['firstname'] = 'first name is require';
    }elseif(min_len($firstname,3)){
        $errors['firstname'] = 'first name must be greater than 3 characters';
    }elseif(max_len($firstname,15)){
        $errors['firstname'] = 'first name must be smaller than 15 characters';
    }elseif(check_unique_name_edit($conn,$firstname,$lastname,$id)){
        $errors['firstname'] = 'first name already taken';
    }
    if(require_input($lastname)){
        $errors['lastname'] = 'last name is require';
    }elseif(min_len($lastname,3)){
        $errors['lastname'] = 'last name must be greater than 3 characters';
    }elseif(max_len($lastname,15)){
        $errors['lastname'] = 'last name must be smaller than 15 characters';
    }

    // email validation

    if(require_input($email)){
        $errors['email'] = 'email is require';
    }elseif(email_validate($email)){
        $errors['email'] = 'not a valid email';
    }elseif(check_unique_email_edit($conn,$email,$id)){
        $errors['email'] = 'email is already taken';
    }

    // password validation
    
    if(require_input($password)){
        $errors['password'] = 'password is require';
    }elseif($password != $password_repeat){
        $errors['password'] = 'password and password confirm must be the same';
    }elseif(min_len($password,6)){
        $errors['password'] = 'password must be larger than or equal 6 characters';
    }elseif(max_len($password,30)){
        $errors['password'] = 'password must be smaller than or equal 30 characters';
    }

    // phone validation

    if(require_input($phone)){
        $errors['phone'] = 'phone is require';
    }elseif(numeric($phone)){
        $errors['phone'] = 'phone must be of type number';
    }elseif(min_len($phone,11)){
        $errors['phone'] = 'phone must be valid in egypt';
    }elseif(max_len($phone,11)){
        $errors['phone'] = 'phone must be valid in egypt';
    }

    // address validation

    if(require_input($address)){
        $errors['address'] = 'address is require';
    }elseif(max_len($address,50)){
        $errors['address'] = 'address must be smaller than 50 characters';
    }

    // city validation

    if(require_input($city)){
        $errors['city'] = 'city is require';
    }elseif(min_len($city,1)){
        $errors['city'] = 'not a valid city info';
    }elseif(max_len($city,1)){
        $errors['city'] = 'not a valid city info';
    }elseif(numeric($city)){
        $errors['city'] = 'not a valid city info';
    }

    // gender validation

    if(require_input($gender)){
        $errors['gender'] = 'gender is require';
    }elseif(min_len($gender,1)){
        $errors['gender'] = 'not a valid gender info';
    }elseif(max_len($gender,1)){
        $errors['gender'] = 'not a valid gender info';
    }elseif(numeric($gender)){
        $errors['gender'] = 'not a valid gender info';
    }

    // image validation

    if(empty($errors)){
        if(!empty($_FILES['image']['name'])){
            $new_image_name = deal_with_image($_FILES['image']);
            if(file_exists('../../uploaded/'.$old_image)){
                unlink('../../uploaded/'.$old_image);
            }
        }else{
            $new_image_name = $old_image;
        }
    }

    // insert user

    if(empty($errors)){
        update_user($conn,$firstname,$lastname,$email,$password,$phone,$address,$new_image_name,$city,$gender,$id);
        $_SESSION['auth'] = ['id' => $id , 'name' => $firstname . ' ' .$lastname , 'email' => $email , 'phone' => $phone , 'permission' => $data['per_name'] , 'address' => $address , 'image' => $new_image_name , 'permission' => $_SESSION['auth']['permission']];
        $_SESSION['success'] = 'your edit is done successfully';
        redirect('../index.php');
    }else{
        $_SESSION['errors'] = $errors;
        redirect('../edit_profile.php');
    }

}else{
    $_SESSION['errors']['method'] = 'wrong request method';
    redirect('../edit_profile.php');
}