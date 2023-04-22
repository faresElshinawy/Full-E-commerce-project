<?php


// get product details function


function get_product_details($conn,$pro_id){
    $sql = "SELECT products.pro_id as id , products.pro_name as name , products.description , products.image , products.count , products.price , categories.`cat name` as category , brands.brand_name as brand  FROM pix.products , pix.categories , pix.brands  WHERE brands.brand_id = products.brand_id AND categories.cat_id = products.cate_id and products.pro_id = '$pro_id' ";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    return $row ;
}

// get product colors


function get_product_colors($conn,$id){
    $sql = "SELECT color_name , colors.color_id FROM pix.colors , pix.product_colors WHERE product_colors.color_id = colors.color_id and product_colors.pro_id = '$id'  ";
    $result = mysqli_query($conn,$sql);
    return $result ;
}