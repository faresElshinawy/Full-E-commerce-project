<?php

// create new which list function

function new_wish_list($conn,$user_id){
    $sql = "INSERT INTO wish_lists (`user_id`) VALUES ('$user_id')";
    mysqli_query($conn,$sql);
    $which_list_id = mysqli_insert_id($conn);
    return $which_list_id;
}

// check if user have which list already function

function check_user_wish_list($conn,$user_id){
    $sql = "SELECT * FROM wish_lists WHERE user_id = '$user_id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    if(!empty($row)){
        return $row['wishlist_id'] ;
    }
    return false;
}

// insert wish list item function

function wishlist_new_item($conn,$wishlist_id,$product_id){
    $sql = "INSERT INTO wishlist_items(`wishlist_id`,`product_id`) VALUES ('$wishlist_id','$product_id')";
    mysqli_query($conn,$sql);
}

// get user wish list items function

function wish_list_items($conn,$user_id){
    $sql = "SELECT products.pro_name as name , products.price as price , wishlist_items.wishlist_item_id as id , products.pro_id  FROM pix.wishlist_items , pix.wish_lists , pix.products WHERE wish_lists.user_id = '$user_id' AND wishlist_items.wishlist_id = wish_lists.wishlist_id AND products.pro_id = wishlist_items.product_id";
    $result = mysqli_query($conn,$sql);
    return $result;
}

// remove from wish list items function

function remove_wishlist_item($conn,$wish_list_item_id){
    $sql = "DELETE FROM wishlist_items WHERE wishlist_item_id = '$wish_list_item_id'";
    mysqli_query($conn,$sql);
}