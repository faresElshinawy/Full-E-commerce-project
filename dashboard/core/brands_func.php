<?php


// get brands function

function get_brands($conn){
    $sql = "SELECT * FROM brands";
    $result = mysqli_query($conn,$sql);
    return $result ;
}

// delete brand by id function

function delete_brand($conn,$id){
    $sql = "DELETE FROM brands WHERE brand_id = '$id'";
    mysqli_query($conn,$sql);
}

// get brand data by id function

function get_brand_by_id($conn,$id){
    $sql = "SELECT * FROM brands WHERE  brand_id = '$id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    return $row ;
}

// brand unique name check function

function check_unique_brand_name($conn,$name){
    $sql = "SELECT * FROM brands";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        if($row['brand_name'] == $name){
            return true ;
        }
    }
    return false ;
}

// insert new brand function

function new_brand($conn,$name,$description,$new_image_name){
    $sql = "INSERT INTO `brands`( `brand_name`, `brand_image`, `brand_description`) VALUES ('$name','$new_image_name','$description')";
    mysqli_query($conn,$sql);
}

// brand unique name check on update function

function check_unique_brand_name_edit($conn,$name,$id){
    $sql = "SELECT * FROM brands WHERE brand_id <> '$id'";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        if($row['brand_name'] == $name){
            return true ;
        }
    }
    return false ;
}

// update brand function

function update_brand($conn,$id,$name,$description,$new_image_name){
    $sql = "UPDATE `brands` SET `brand_name`='$name',`brand_image`='$new_image_name',`brand_description`='$description' ,`updated_at`= CURRENT_TIMESTAMP WHERE brand_id = '$id'";
    mysqli_query($conn,$sql);
}