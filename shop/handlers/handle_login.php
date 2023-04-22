<?php
session_start();
require_once '../../database/conn.php';
require_once '../core/login_func.php';
require_once '../core/validation.php';
require_once '../core/functions.php';
$errors = [];

if(check_request_method('POST')){
    
    // sanitize inputs
    foreach($_POST as $key => $value){
        $$key = sanitize_input($value);
    }


    // email validation

    if(require_input($email)){
        $errors['email'] = 'email is require';
    }elseif(email_validate($email)){
        $errors['email'] = 'not a valid email';
    }

    // password validation
    
    if(require_input($password)){
        $errors['password'] = 'password is require';
    }elseif(min_len($password,6)){
        $errors['password'] = 'password must be larger than or equal 6 characters';
    }elseif(max_len($password,30)){
        $errors['password'] = 'password must be smaller than or equal 30 characters';
    }

    $data = login($conn,$email,$password);
    if(!$data){
        $errors['wrong'] = 'wrong user info';
    }

    if(empty($errors)){
        if($data['per_name'] == 'admin' || ($data['per_name'] == 'employee')){
            $_SESSION['success'] = 'loged in successfully';
            $_SESSION['auth'] = ['id' => $data['user_id'] , 'name' =>  $data['first_name'] . ' ' . $data['last_name']  , 'email' => $data['email'] , 'permission' => $data['per_name'] , 'address' => $data['address'] , 'image' => $data['image'] , 'permission' => $data['per_name'] , 'phone' => $data['phone']];
            redirect('../../dashboard/index.php');
        }else{
            $_SESSION['success'] = 'loged in successfully';
            $_SESSION['auth'] = ['id' => $data['user_id'] , 'name' => $data['first_name'] . ' ' . $data['last_name'] , 'email' => $data['email'] , 'phone' => $data['phone'] , 'permission' => $data['per_name'] , 'address' => $data['address'] , 'image' => $data['image'] , 'permission' => $data['per_name'] , 'phone' => $data['phone']];
            redirect('../../index.php');
        }
    }else{
        $_SESSION['errors'] = $errors;
        redirect('../../index.php?page=login');
    }

}else{
    $_SESSION['errors']['method'] = 'wrong request method';
    redirect('../../index.php?page=register');
}