<?php

// get oreders data function

function get_orders($conn){
    $sql = 'SELECT orders.order_id , first_name , last_name  , status_name , order_status_id , products_count , del_address , orders.created_at , total_price   FROM pix.users , pix.orders_status , pix.orders WHERE users.user_id = orders.user_id AND orders_status.status_id = orders.order_status_id';
    $result = mysqli_query($conn,$sql);
    return $result ;
}

// delet order function

function delete_order($conn,$id){
    $sql = "DELETE FROM orders WHERE order_id = '$id'";
    mysqli_query($conn,$sql);
}

// show order products function

function get_order_items($conn,$id){
    $sql = "SELECT products.pro_name ,products.price FROM pix.order_items  , pix.products WHERE  '$id' = order_items.order_id AND products.pro_id = order_items.product_id";
    $result = mysqli_query($conn,$sql);
    return $result ;
}

// show order products with order id function

function get_order_items_by_order_id($conn,$id,$user_id){
    $sql = "SELECT products.pro_id , products.pro_name , products.price , order_items.order_item_id FROM pix.orders , pix.order_items , pix.products WHERE  orders.user_id =  '$user_id' AND '$id' = order_items.order_id AND order_items.product_id = products.pro_id";
    $result = mysqli_query($conn,$sql);
    return $result ;
}

// show order products with order id only function

function get_order_items_by_order_id_only($conn,$id){
    $sql = "SELECT products.pro_id , products.pro_name , products.price , order_items.order_item_id FROM  pix.order_items , pix.products WHERE '$id' = order_items.order_id AND order_items.product_id = products.pro_id";
    $result = mysqli_query($conn,$sql);
    return $result ;
}


// get user oreders data function

function get_orders_by_id($conn,$user_id,$status){
    $sql = "SELECT orders.order_id , orders_status.status_name  , products_count , del_address , total_price   FROM pix.users , pix.orders_status , pix.orders WHERE users.user_id = orders.user_id AND orders_status.status_id = orders.order_status_id AND orders_status.status_name = '$status' AND orders.user_id = '$user_id';";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    return $row ;
}


// insert new order item function

function new_order_item($conn,$order_id,$pro_id,$pro_color){
    $sql = "INSERT INTO `order_items`(`order_id`, `product_id`, `color_id`) VALUES ('$order_id','$pro_id','$pro_color')";
    mysqli_query($conn,$sql);
}

// start new order function

function new_order($conn,$user_id,$address){
    $sql = "INSERT INTO orders (user_id,del_address,order_status_id) VALUES ('$user_id','$address','1')";
    mysqli_query($conn,$sql);
    $order_id = mysqli_insert_id($conn);
    return $order_id;
}

// update product count function

function update_pro_count($conn,$pro_id){
    $sql = "SELECT count , solded_out FROM products WHERE pro_id = '$pro_id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $new_count = $row['count'] - 1 ;
    $solded = $row['solded_out'] + 1 ;
    $sql = "UPDATE products SET count='$new_count' , solded_out = '$solded' WHERE pro_id = '$pro_id' ";
    mysqli_query($conn,$sql);
}


// update order count and total price function

function update_order_price($conn,$pro_id,$id,$order_id){
    $sql = "SELECT products_count , total_price , price  FROM pix.orders , pix.products WHERE user_id = '$id' AND products.pro_id = '$pro_id' AND orders.order_id = '$order_id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $new_count = $row['products_count'] + 1 ;
    $new_price = $row['total_price'] + $row['price'] ;
    $sql = "UPDATE orders SET products_count ='$new_count' , total_price = '$new_price' WHERE user_id = '$id' AND order_id = '$order_id'";
    mysqli_query($conn,$sql);
}

// re order function

function re_order($conn,$order_id,$user_id,$address){
    $sql = "SELECT product_id , color_id FROM order_items WHERE order_id = '$order_id'";
    $result = mysqli_query($conn,$sql);
    new_order($conn,$user_id,$address);
    $id = mysqli_insert_id($conn);
    while($row1 = mysqli_fetch_assoc($result)){
        $product_id = $row1['product_id'];
        $product_color = $row1['color_id'];
        $sql = "INSERT INTO order_items(order_id,product_id,color_id) VALUES ('$id','$product_id','$product_color')";
        mysqli_query($conn,$sql);
        update_pro_count($conn,$product_id);
        update_order_price($conn,$product_id,$user_id,$id);
    }
    $sql = "UPDATE orders SET order_status_id = '2' WHERE order_id = '$id'";
    mysqli_query($conn,$sql);
}

// approve order function

function approved_order($conn,$order_id){
    $sql = "UPDATE orders SET order_status_id = '3' WHERE order_id = '$order_id'";
    mysqli_query($conn,$sql);
}

// get oreders by status function

function get_orders_by_status($conn,$status){
    $sql = "SELECT orders.order_id , first_name , last_name  , status_name , order_status_id , products_count , del_address , orders.created_at , total_price   FROM pix.users , pix.orders_status , pix.orders WHERE users.user_id = orders.user_id AND orders_status.status_id = orders.order_status_id AND orders.order_status_id = '$status'";
    $result = mysqli_query($conn,$sql);
    return $result ;
}

// reject order function

function reject_order($conn,$order_id){
    $sql = "UPDATE orders SET order_status_id = '4' WHERE order_id = '$order_id'";
    mysqli_query($conn,$sql);
}


