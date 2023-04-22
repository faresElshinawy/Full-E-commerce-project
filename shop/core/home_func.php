<?php

// get categories limited function

function get_categories_limit($conn){
    $sql = 'SELECT * FROM categories LIMIT 6';
    $result = mysqli_query($conn,$sql);
    return $result;
}


// get brands limit 2 function

function get_brands_limit($conn){
    $sql = "SELECT * FROM brands  ORDER BY brand_id DESC LIMIT 2";
    $result = mysqli_query($conn,$sql);
    return $result ;
}


// get latest proudcts function

function get_latest_product($conn){
    $sql = "SELECT * FROM products ORDER BY pro_id DESC LIMIT 8";
    $result = mysqli_query($conn,$sql);
    return $result ;
}

// get all categories function

function get_categories($conn){
    $sql = "SELECT * FROM categories";
    $result = mysqli_query($conn,$sql);
    return $result ;
}


// get all brands function

function get_brands($conn){
    $sql = "SELECT * FROM brands";
    $result = mysqli_query($conn,$sql);
    return $result ;
}

// get all products most selling function

function get_products_most_selling_home($conn){
    $sql = "SELECT products.pro_id as id , products.pro_name as name , products.description , products.image , products.count , products.price , categories.`cat name` as category , brands.brand_name as brand  FROM pix.products , pix.categories , pix.brands  WHERE brands.brand_id = products.brand_id AND categories.cat_id = products.cate_id ORDER BY products.solded_out DESC LIMIT 8";
    $result = mysqli_query($conn,$sql);
    return $result ;
}

