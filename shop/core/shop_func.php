<?php


// get all products function

function get_products($conn){
    $sql = "SELECT products.pro_id as id , products.pro_name as name , products.description , products.image , products.count , products.price , categories.`cat name` as category , brands.brand_name as brand  FROM pix.products , pix.categories , pix.brands  WHERE brands.brand_id = products.brand_id AND categories.cat_id = products.cate_id ";
    $result = mysqli_query($conn,$sql);
    return $result ;
}


// get all products max price function

function get_products_max($conn){
    $sql = "SELECT products.pro_id as id , products.pro_name as name , products.description , products.image , products.count , products.price , categories.`cat name` as category , brands.brand_name as brand  FROM pix.products , pix.categories , pix.brands  WHERE brands.brand_id = products.brand_id AND categories.cat_id = products.cate_id ORDER BY price DESC ";
    $result = mysqli_query($conn,$sql);
    return $result ;
}

// get all products mix price function

function get_products_min($conn){
    $sql = "SELECT products.pro_id as id , products.pro_name as name , products.description , products.image , products.count , products.price , categories.`cat name` as category , brands.brand_name as brand  FROM pix.products , pix.categories , pix.brands  WHERE brands.brand_id = products.brand_id AND categories.cat_id = products.cate_id ORDER BY price ASC ";
    $result = mysqli_query($conn,$sql);
    return $result ;
}


// get all products latest function

function get_products_latest($conn){
    $sql = "SELECT products.pro_id as id , products.pro_name as name , products.description , products.image , products.count , products.price , categories.`cat name` as category , brands.brand_name as brand  FROM pix.products , pix.categories , pix.brands  WHERE brands.brand_id = products.brand_id AND categories.cat_id = products.cate_id ORDER BY products.pro_id DESC";
    $result = mysqli_query($conn,$sql);
    return $result ;
}

// get all products latest function

function get_search($conn,$name){
    $sql = "SELECT products.pro_id as id , products.pro_name as name , products.description , products.image , products.count , products.price , categories.`cat name` as category , brands.brand_name as brand  FROM pix.products , pix.categories , pix.brands  WHERE brands.brand_id = products.brand_id AND categories.cat_id = products.cate_id AND products.pro_name LIKE '%$name%'";
    $result = mysqli_query($conn,$sql);
    return $result ;
}


// get all products by category function

function get_category_products($conn,$cat_id){
    $sql = "SELECT pro_id as id , pro_name as name , description , image , count , price , cate_id FROM products  WHERE  '$cat_id' = cate_id ";
    $result = mysqli_query($conn,$sql);
    return $result ;
}


// get all products by brand function

function get_brand_products($conn,$brand_id){
    $sql = "SELECT pro_id as id , pro_name as name , description , image , count , price , cate_id FROM products  WHERE  '$brand_id' = brand_id ";
    $result = mysqli_query($conn,$sql);
    return $result ;
}

// get all products most selling function

function get_products_most_selling($conn){
    $sql = "SELECT products.pro_id as id , products.pro_name as name , products.description , products.image , products.count , products.price , categories.`cat name` as category , brands.brand_name as brand  FROM pix.products , pix.categories , pix.brands  WHERE brands.brand_id = products.brand_id AND categories.cat_id = products.cate_id ORDER BY products.solded_out DESC";
    $result = mysqli_query($conn,$sql);
    return $result ;
}



