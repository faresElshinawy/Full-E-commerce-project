<?php 

// add product comment function

function  new_pro_comment($conn,$user_id,$product_id,$comment){
    $sql = "INSERT INTO `product_reviews`(`pro_id`, `user_id`, `comment`) VALUES ('$product_id','$user_id','$comment')";
    mysqli_query($conn,$sql) ;
}

// get product reviews count function

function reviews_count($conn,$pro_id){
    $sql = "SELECT COUNT(product_review_id) as count FROM product_reviews WHERE pro_id = '$pro_id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    return $row ;
}

// get product comments function

function get_product_comment($conn,$product_id){
    $sql = "SELECT product_reviews.product_review_id , product_reviews.pro_id ,  comment , first_name , last_name , users.user_id , image FROM product_reviews INNER JOIN users WHERE pro_id = $product_id and product_reviews.user_id = users.user_id";
    $result = mysqli_query($conn,$sql);
    return $result ;
}

// delete product review comment function

function delete_comment($conn,$comment_id){
    $sql = "DELETE FROM product_reviews WHERE product_review_id = '$comment_id'";
    mysqli_query($conn,$sql);
}