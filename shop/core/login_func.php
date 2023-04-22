<?php 

// get all users data function

function users_data($conn){
    $sql = "SELECT user_id , first_name , last_name , email , password , phone , address , image , per_name FROM pix.users , pix.genders , pix.cities , pix.permissions WHERE
    users.gender_id = genders.gender_id AND users.city_id = cities.city_id AND permissions.per_id = users.permission_id";
    $result = mysqli_query($conn,$sql);
    return $result ;
}

// user auth check function

function login($conn,$email,$password){
    $data = users_data($conn);
    while($row = mysqli_fetch_assoc($data)){
        if($row['email'] == $email && $row['password'] == $password){
            return $row;
        }
    }
    return false ;
}


