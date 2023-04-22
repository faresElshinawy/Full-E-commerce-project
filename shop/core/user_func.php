<?php 
    // get gender data function

    function get_gender_data($conn){
        $sql = "SELECT * FROM genders";
        $result = mysqli_query($conn,$sql);
        return $result;
    }

    // get city data function

    function get_city_data($conn){
        $sql = "SELECT * FROM cities";
        $result = mysqli_query($conn,$sql);
        return $result;
    }

    // unique first name check function

    function check_unique_name($conn,$first_name,$last_name){
        $sql = 'SELECT  first_name FROM users';
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            if($row['first_name'] . $row['last_name'] == $first_name . $last_name){
                return true ;
            }
            return false ;
        }
    }

        // unique first name check function

        function check_unique_name_edit($conn,$first_name,$last_name,$id){
            $sql = "SELECT  first_name FROM users WHERE user_id <> '$id'";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){
                if($row['first_name'] . $row['last_name'] == $first_name . $last_name){
                    return true ;
                }
                return false ;
            }
        }

    // unique email check function

    function check_unique_email($conn,$email){
        $sql = 'SELECT  email FROM users';
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            if($row['email'] == $email ){
                return true ;
            }
            return false ;
        }
    }

    // unique email check function

    function check_unique_email_edit($conn,$email,$id){
        $sql = "SELECT  email FROM users WHERE user_id <> '$id'";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            if($row['email'] == $email ){
                return true ;
            }
            return false ;
            }
        }


    // get all users data function

    function users_data($conn){
        $sql = "SELECT user_id , first_name , last_name , email , password , phone , address , image , gender_name , city_name , per_name FROM pix.users , pix.genders , pix.cities , pix.permissions WHERE
        users.gender_id = genders.gender_id AND users.city_id = cities.city_id AND permissions.per_id = users.permission_id";
        $result = mysqli_query($conn,$sql);
        return $result ;
    }

    // insert new user function

    function new_user($conn , $firstname , $lastname , $email , $password , $phone , $address , $image , $city , $gender){
        $sql = "INSERT INTO `users`(`first_name`, `last_name`, `email`, `password`, `phone`, `address`, `image`, `city_id`, `gender_id`,`permission_id`) VALUES ('$firstname','$lastname','$email','$password','$phone','$address','$image','$city','$gender','3')";
        mysqli_query($conn,$sql);
    }

    // get user info by id function

    function user_id_info($conn,$id){

        $sql = "SELECT user_id , first_name , last_name , email , password , phone , address , image , gender_name , city_name , per_name FROM pix.users , pix.genders , pix.cities , pix.permissions WHERE
        users.gender_id = genders.gender_id AND users.city_id = cities.city_id AND permissions.per_id = users.permission_id and user_id = '$id'";

        $result =  mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        return $row ;
        
    }

    // get user orders function

    function user_orders($conn,$id){
        $sql = "SELECT first_name , last_name , orders.order_id , orders_status.status_name , orders.del_address , orders.products_count , orders.total_price FROM `users`,`orders`,`orders_status` WHERE users.user_id = '$id' AND orders.user_id = '$id' AND orders_status.status_id = orders.order_status_id ";
        $result = mysqli_query($conn,$sql);
        return $result ;
    }

    // delete user function

    function delete_user($conn,$id){
        $sql = "DELETE FROM users WHERE user_id = '$id'";
        mysqli_query($conn,$sql);
    }

    // get permissions data function

    function per_data($conn){
        $sql = "SELECT * FROM permissions";
        $result = mysqli_query($conn,$sql);
        return $result ;
    }

    // update user data function

    function update_user($conn,$firstname,$lastname,$email,$password,$phone,$address,$new_image_name,$city,$gender,$id){
        $sql = "UPDATE `users` SET `first_name`='$firstname',`last_name`='$lastname',`email`='$email',`password`='$password',`phone`='$phone',`address`='$address',`image`='$new_image_name',`city_id`='$city',`gender_id`='$gender',`updated_at`= current_timestamp WHERE user_id = '$id'";
        mysqli_query($conn,$sql);
    }
