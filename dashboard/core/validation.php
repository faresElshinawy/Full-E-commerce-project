<?php


    // request method validation

    function check_request_method($method){
        if($_SERVER['REQUEST_METHOD'] == $method){
            return true;
        }
        return false;
    }

    // input sanitize function

    function sanitize_input($input){
        return trim(htmlspecialchars(htmlentities($input)));
    }

    // max length function

    function max_len($input , $num){
        if(strlen($input) <= $num){
            return false;
        }
        return true ;
    }

    // require function

    function require_input($input){
        if(!empty($input)){
            return false ;
        }
        return true ;
    }


    // min length function

    function min_len($input , $num){
        if(strlen($input) >= $num){
            return false ;
        }
        return true ;
    }


    // email validation

    function email_validate($email){
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            return false ;
        }
        return true ;
    }   

    // image validation

    function deal_with_image($image){
        $image_name = $image['name'];
        $image_tmp_name = $image['tmp_name'];
        $image_type = $image['type'];
        $image_errors = $image['error'];
        $image_size = $image['size'];
        if($image_errors != '0'){
            $GLOBALS['errors']['image'] = 'choose another image';
        }
        if($image_size > 5770000){
            $GLOBALS['errors']['image'] = 'image size is too large';
        }
        $image_path = pathinfo($image_name);
        $ext = $image_path['extension'];
        $image_mime_type = getimagesize($image_tmp_name);
        $allowed_types = ['image/jpeg','image/png','image/gif'];
        if(!in_array($image_mime_type['mime'],$allowed_types)){
            $GLOBALS['errors']['image'] = 'image file type is not allowed';
        }
        $image_new_name = uniqid('',true)  . '.' .$ext ;
        $path = '../../uploaded/';
        move_uploaded_file($image_tmp_name, $path . $image_new_name );
        return $image_new_name ;
    }

    // input is numeric function

        function numeric($input){
            if(is_numeric($input)){
                return false ;
            }
            return true ;
        }