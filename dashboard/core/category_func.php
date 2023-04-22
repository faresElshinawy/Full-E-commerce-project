<?php 

// get brands function

function get_brands($conn){
    $sql = 'SELECT * FROM brands';
    $result = mysqli_query($conn,$sql);
    return $result;
}

// get categories function

function get_categories($conn){
    $sql = 'SELECT * FROM categories';
    $result = mysqli_query($conn,$sql);
    return $result;
}

// unique category name chack function

function check_unique_category_name($conn,$name){
        $sql = "SELECT `cat name` FROM categories";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            if($row['cat name'] == $name){
                return true ;
            }
        }
        return false;
    }

// insert new category function

function new_category($conn,$name,$description,$new_image_name){
    $sql = "INSERT INTO `categories`( `cat name`, `cat_image`, `cat_description`) VALUES 
    ('$name','$new_image_name','$description')";
    mysqli_query($conn,$sql);
}

// delete category function

function delete_category($conn,$id){
    $sql = "DELETE FROM categories WHERE cat_id = '$id'";
    mysqli_query($conn,$sql);
}

// get catgory by id function

function get_category_by_id($conn,$id){
    $sql = "SELECT * FROM categories WHERE cat_id = '$id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    return $row ;
}

// update category data

function update_category($conn,$id,$name,$description,$new_image_name){
    $sql = "UPDATE `categories` SET 
    `cat name`='$name' , `cat_image`='$new_image_name' , `cat_description`='$description' , `updated_at`= CURRENT_TIMESTAMP WHERE cat_id = '$id'";
    $result = mysqli_query($conn,$sql);
}

// check unique category id on update

function check_unique_category_name_edit($conn,$name,$id){
    $sql = "SELECT cat_id , `cat name` FROM categories WHERE cat_id <> '$id'";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        if($row['cat name'] == $name){
            return true ;
        }
    }
    return false ;
}
?>