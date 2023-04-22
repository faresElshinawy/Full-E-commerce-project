<?php


    // get products function

    function get_all_products($conn){
        $sql = "SELECT products.pro_id as id , pro_name , description , `cat name` , brand_name , image , `count` , price , solded_out FROM pix.products , pix.categories , pix.brands WHERE products.brand_id = brands.brand_id AND products.cate_id = categories.cat_id ";
        $result = mysqli_query($conn,$sql);
        return $result ;
    }

    // get product colors function

    function get_product_colors($conn,$id){
        $sql = "SELECT products.pro_id as id , colors.color_id , color_name FROM pix.products , pix.colors , pix.product_colors  WHERE products.pro_id = '$id' AND colors.color_id = product_colors.color_id AND products.pro_id = product_colors.pro_id";
        $result = mysqli_query($conn,$sql);
        return $result ;
    }

    // delete product color function

    function delete_product_color($conn,$id,$color_id){
        $sql = "DELETE FROM `product_colors` WHERE pro_id = '$id' AND color_id = '$color_id'";
        $result = mysqli_query($conn,$sql);
    }

    // get categories function

    function get_categories($conn){
        $sql = 'SELECT * FROM categories';
        $result = mysqli_query($conn,$sql);
        return $result;
    }

    // get brands function

    function get_brands($conn){
        $sql = 'SELECT * FROM brands';
        $result = mysqli_query($conn,$sql);
        return $result;
    }

    // unique product name function

    function check_unique_product_name($conn,$name){
        $sql = "SELECT pro_name from products";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            if($row['pro_name'] == $name){
                return true ;
            }
        }
        return false ;
    }

    // insert new product

    function new_product($conn,$name,$description,$cate_id,$brand_id,$image,$count,$price){

        $sql = "INSERT INTO `products`( `pro_name`, `description`, `cate_id`, `brand_id`, `image`, `count`, `price`,`solded_out`) VALUES ('$name','$description','$cate_id','$brand_id','$image','$count','$price','0')";
        mysqli_query($conn,$sql); 

    }

    // get product by id function

    function get_product_by_id($conn,$id){
        $sql = "SELECT * FROM products WHERE pro_id = '$id'";
        $result = mysqli_query($conn,$sql) ;
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    // get all colors function

    function get_colors($conn){
            $sql =  "SELECT * FROM colors";
            $result = mysqli_query($conn,$sql);
            return $result;
    }

    // new product_colors function

    function new_product_colors($conn,$prod_id,$color_id){
        foreach($color_id as $id){
            $sql = "INSERT INTO `product_colors`( `pro_id`, `color_id`) VALUES ('$prod_id','$id')";
            mysqli_query($conn,$sql);
        }
    }

    // delete product function

    function delete_product($conn,$id){
            $sql = "DELETE FROM products WHERE pro_id = '$id'";
            mysqli_query($conn,$sql);
    }

    // edit product color function

    function edit_product_color($conn,$id){
        $sql = "SELECT products.pro_id , product_colors.color_id as pro_color_id , colors.color_id  , colors.color_name FROM `products` INNER JOIN `product_colors` ON products.pro_id = '$id' AND products.pro_id = product_colors.pro_id RIGHT OUTER JOIN `colors` ON colors.color_id = product_colors.color_id ;";
        $result = mysqli_query($conn,$sql);
        return $result ;
    }

    // unique product name when edit function

    function check_unique_product_name_edit($conn,$name,$id){
        $sql = "SELECT pro_id , pro_name FROM products WHERE pro_id <> '$id'";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            if($row['pro_name'] == $name){
                return true ;
            }
        }
        return false ;
    }

    // update product data

    function update_product_data($conn,$id,$name,$description,$category,$brand,$new_image_name,$count,$price){
        $sql = "UPDATE `products` SET `pro_name`='$name',`description`='$description',`image`='$new_image_name',`cate_id`='$category',`brand_id`='$brand',`count`='$count',`price`='$price' WHERE pro_id = '$id'";
        mysqli_query($conn,$sql);
    }

    // delete product color on update function

    function delete_product_color_on_edit($conn,$id){
        $sql = "DELETE FROM `product_colors` WHERE pro_id = '$id'";
        $result = mysqli_query($conn,$sql);
    }