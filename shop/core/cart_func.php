<?php

// show order products with order id function

function get_order_items_by_order_id($conn,$id,$user_id){
    $sql = "SELECT products.pro_id , products.pro_name , products.price , order_items.order_item_id FROM  pix.order_items , pix.products WHERE '$id' = order_items.order_id AND order_items.product_id = products.pro_id";
    $result = mysqli_query($conn,$sql);
    return $result ;
}

// get order_id function

function get_order_id($conn,$user_id){
    $sql = "SELECT orders.order_id  FROM pix.orders WHERE user_id = '$user_id' AND order_status_id = '1' ";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    return $row ;
}

// get user oreders data function

function get_orders_by_id($conn,$user_id,$status){
    $sql = "SELECT orders.order_id , orders_status.status_name  , products_count , del_address , total_price   FROM pix.users , pix.orders_status , pix.orders WHERE users.user_id = orders.user_id AND orders_status.status_id = orders.order_status_id AND orders_status.status_name = '$status' AND orders.user_id = '$user_id';";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    return $row ;
}

// update product count function

function update_pro_count($conn,$pro_id){
    $sql = "SELECT count , solded_out FROM products WHERE pro_id = '$pro_id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $new_count = $row['count'] + 1 ;
    $solded = $row['solded_out'] - 1 ;
    $sql = "UPDATE products SET count='$new_count' , solded_out = '$solded' WHERE pro_id = '$pro_id' ";
    mysqli_query($conn,$sql);
}


// update order count and total price function

function update_order_price($conn,$pro_id,$user_id,$order_id){
    $sql = "SELECT products_count , total_price , price  FROM pix.orders , pix.products WHERE orders.user_id = '$user_id' AND products.pro_id = '$pro_id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $new_count = $row['products_count'] - 1 ;
    $new_price = $row['total_price'] - $row['price'] ;
    $sql = "UPDATE orders SET products_count ='$new_count' , total_price = '$new_price' WHERE user_id = '$user_id' AND order_id = '$order_id'";
    mysqli_query($conn,$sql);
}

// cart delete function

function  delete_order_item($conn,$order_id,$id){
    $sql = "DELETE  FROM order_items WHERE order_id = '$order_id' AND order_item_id = '$id'";
    mysqli_query($conn,$sql);
}

// get order total price function

function total_price($conn,$order_id){
    $sql = "SELECT total_price , products_count FROM orders WHERE order_id = '$order_id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    return $row ;
}

// order submit function 

function submit_order($conn,$order_id){
    $sql = "UPDATE orders SET order_status_id = '2' WHERE order_id = '$order_id'";
    mysqli_query($conn,$sql);
}