<?php 



// DUMMY DATA AT THE END OF PAGE

// host name
const HOST = 'localhost';

// user name
const USER = 'root';

// user password 
const PASSWORD = '';

// database name
const DB_NAME = 'pix';


// ***********************************************************************

// create database fucntion

function create_database(){
    try{
        $conn = mysqli_connect(HOST,USER,PASSWORD);
    }
    catch(Exception $e){
        header('location: ../view/shop/error.php');
        die;
    }
    $conn = mysqli_connect(HOST,USER,PASSWORD);
    $sql = "CREATE DATABASE IF NOT EXISTS `pix`";
    mysqli_query($conn,$sql);
}

create_database();


// ***********************************************************************

// database connection function

function db_conn(){
    try{
        $conn = mysqli_connect(HOST,USER,PASSWORD,DB_NAME);
    }
    catch (Exception $e){
        header('location: ../view/shop/error.php');
        die;
    }
    $conn = mysqli_connect(HOST,USER,PASSWORD,DB_NAME);
    return $conn;
}

$conn = db_conn();



// ***********************************************************************

// create permissions table

$sql = "CREATE TABLE IF NOT EXISTS `permissions`(
    `per_id` INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT ,
    `per_name` VARCHAR(20) NOT NULL
)";

mysqli_query($conn,$sql);



// ***********************************************************************

// create cities table

$sql = "CREATE TABLE IF NOT EXISTS `cities`(
    `city_id` INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT ,
    `city_name` VARCHAR(20) NOT NULL
)";

mysqli_query($conn,$sql);

// ***********************************************************************

// create genders table

$sql = "CREATE TABLE IF NOT EXISTS `genders`(
    `gender_id` INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT ,
    `gender_name` VARCHAR(20) NOT NULL
)";

mysqli_query($conn,$sql);

// ***********************************************************************

// create users table

$sql = "CREATE TABLE IF NOT EXISTS `users`(
    `user_id` INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT ,
    `first_name` VARCHAR(15) NOT NULL ,
    `last_name` VARCHAR(15) NOT NULL ,
    `email`  VARCHAR(100) NOT NULL ,
    `password` VARCHAR(100) NOT NULL ,
    `phone` INT NOT NULL ,
    `address`  VARCHAR(100) NOT NULL ,
    `image` VARCHAR(100) NOT NULL ,
    `city_id` INT UNSIGNED NOT NULL ,
    FOREIGN KEY (city_id) REFERENCES cities(city_id) ON DELETE NO ACTION,
    `gender_id` INT UNSIGNED NOT NULL,
    FOREIGN KEY (gender_id) REFERENCES genders(gender_id),
    `created_at`  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
    `updated_at` TIMESTAMP null,
    `permission_id` INT UNSIGNED NOT NULL ,
    FOREIGN KEY (permission_id) REFERENCES `permissions`(per_id)
)";

mysqli_query($conn,$sql);

// ***********************************************************************

// create categories table

    $sql = "CREATE TABLE IF NOT EXISTS categories(
        `cat_id` INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT ,
        `cat name` VARCHAR(30) NOT NULL ,
        `cat_image` VARCHAR(100) NOT NULL ,
        `cat_description` VARCHAR(200) ,
        `created_at`  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
        `updated_at` TIMESTAMP null
    )";

mysqli_query($conn,$sql);

// ***********************************************************************

// create brands table

$sql = "CREATE TABLE IF NOT EXISTS brands(
    `brand_id` INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT ,
    `brand_name` VARCHAR(30) NOT NULL ,
    `brand_image` VARCHAR(100) NOT NULL ,
    `brand_description` VARCHAR(200) ,
    `created_at`  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
    `updated_at` TIMESTAMP null
)";

mysqli_query($conn,$sql);


// ***********************************************************************

// create products table

$sql = "CREATE TABLE IF NOT EXISTS products(
    `pro_id` INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT ,
    `pro_name` VARCHAR(30) NOT NULL ,
    `description` VARCHAR(200) NOT NULL ,
    `image` VARCHAR(100) NOT NULL ,
    `cate_id` INT UNSIGNED NOT NULL ,
    FOREIGN KEY (cate_id) REFERENCES categories(cat_id) ON DELETE CASCADE ,
    `brand_id` INT UNSIGNED NOT NULL ,
    FOREIGN KEY (brand_id) REFERENCES brands(brand_id) ON DELETE CASCADE ,
    `count` INT UNSIGNED ,
    `price` INT UNSIGNED ,
    `solded_out` INT UNSIGNED
)";

mysqli_query($conn,$sql);

// ***********************************************************************

// create colors table

$sql = "CREATE TABLE IF NOT EXISTS colors(
    `color_id` INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT ,
    `color_name` VARCHAR(30) NOT NULL 
)";

mysqli_query($conn,$sql);

// ***********************************************************************

// create product_colors table

    $sql = "CREATE TABLE IF NOT EXISTS product_colors(
        `product_color_id` INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT ,
        `pro_id` INT UNSIGNED NOT NULL ,
        FOREIGN KEY (pro_id) REFERENCES products(pro_id) ON DELETE CASCADE,
        `color_id` INT UNSIGNED NOT NULL ,
        FOREIGN KEY (color_id) REFERENCES colors(color_id) ON DELETE CASCADE
    )";

mysqli_query($conn,$sql);

// ***********************************************************************

// create product_reviews table

$sql = "CREATE TABLE IF NOT EXISTS product_reviews(
    `product_review_id` INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT ,
    `pro_id` INT UNSIGNED NOT NULL ,
    FOREIGN KEY (pro_id) REFERENCES products(pro_id) ON DELETE CASCADE,
    `user_id` INT UNSIGNED NOT NULL ,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ,
    `comment` VARCHAR(255) NOT NULL 
)";

mysqli_query($conn,$sql);


// ***********************************************************************

// create images table

// $sql = "CREATE TABLE IF NOT EXISTS images(
//     `image_id` INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT  ,
//     `product_id` INT UNSIGNED NOT NULL  ,
//     FOREIGN KEY (product_id) REFERENCES products(pro_id) ON DELETE CASCADE, 
//     `image_name` VARCHAR(100) NOT NULL 
// )";

// mysqli_query($conn,$sql);

// ***********************************************************************

// create order status table

$sql = "CREATE TABLE IF NOT EXISTS orders_status(
    `status_id` INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT ,
    `status_name` VARCHAR(100) NOT NULL 
)";

mysqli_query($conn,$sql);

// ***********************************************************************

// create order table

$sql = "CREATE TABLE IF NOT EXISTS orders(
    `order_id` INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT ,
    `user_id` INT UNSIGNED NOT NULL  ,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ,
    `order_status_id` INT UNSIGNED NOT NULL  ,
    FOREIGN KEY (order_status_id) REFERENCES orders_status(status_id) ,
    `products_count`  INT UNSIGNED DEFAULT '0' ,
    `del_address` VARCHAR(100) NOT NULL ,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
    `total_price` INT UNSIGNED DEFAULT '0'

)";

mysqli_query($conn,$sql);

// ***********************************************************************

// create order items table

$sql = "CREATE TABLE IF NOT EXISTS order_items(
    `order_item_id` INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT ,
    `order_id` INT UNSIGNED  NOT NULL  ,
    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE ,
    `product_id` INT UNSIGNED NOT NULL  ,
    FOREIGN KEY (product_id) REFERENCES products(pro_id) ON DELETE CASCADE ,
    `color_id` INT UNSIGNED NOT NULL  ,
    FOREIGN KEY (color_id) REFERENCES colors(color_id) 
)";

mysqli_query($conn,$sql);

// ***********************************************************************

// create wish lists table

$sql = "CREATE TABLE IF NOT EXISTS wish_lists(
    `wishlist_id` INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT ,
    `user_id` INT UNSIGNED NOT NULL  ,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE 
)";

mysqli_query($conn,$sql);

// ***********************************************************************

// create wish lists table

$sql = "CREATE TABLE IF NOT EXISTS wishlist_items(
    `wishlist_item_id` INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT ,
    `wishlist_id` INT UNSIGNED  NOT NULL  ,
    FOREIGN KEY (wishlist_id) REFERENCES wish_lists(wishlist_id) ON DELETE CASCADE ,
    `product_id` INT UNSIGNED NOT NULL  ,
    FOREIGN KEY (product_id) REFERENCES products(pro_id) ON DELETE CASCADE
)";

mysqli_query($conn,$sql);


// ***********************************************************************

// create feedbacks table

$sql = "CREATE TABLE IF NOT EXISTS feedbacks(
    `feedback_id` INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT ,
    `user_id` INT UNSIGNED NOT NULL  ,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ,
    `message` VARCHAR(255) NOT NULL 
)";

mysqli_query($conn,$sql);

// ***********************************************************************


// DUMMY DATA


// $sql = "INSERT INTO `cities` (`city_id`, `city_name`) VALUES (NULL, 'tanta'), (NULL, 'ciro')";


// mysqli_query($conn,$sql);


// $sql = "INSERT INTO `genders` (`gender_id`, `gender_name`) VALUES (NULL, 'male'), (NULL, 'female')";

// mysqli_query($conn,$sql);


// $sql = "INSERT INTO `permissions` (`per_id`, `per_name`) VALUES (NULL, 'admin'), (NULL, 'employee'), (NULL, 'user')";

// mysqli_query($conn,$sql);


// $sql = "INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `phone`, `address`, `image`, `city_id`, `gender_id`, `created_at`, `updated_at`, `permission_id`) VALUES (NULL, 'fares', 'elshinawy', 'test@eraasoft.com', '123456', '01100162900', 'el dokki', '643657606ca492.16477303.jpeg', '1', '1', current_timestamp(), NULL, '1');";

// mysqli_query($conn,$sql);



// $sql = "INSERT INTO `orders_status` (`status_id`, `status_name`) VALUES (NULL, 'unconfirmed')";

// mysqli_query($conn,$sql);


// $sql = "INSERT INTO `orders_status` (`status_id`, `status_name`) VALUES (NULL, 'under processing')";

// mysqli_query($conn,$sql);


// $sql = "INSERT INTO `orders_status` (`status_id`, `status_name`) VALUES (NULL, 'delivered')";

// mysqli_query($conn,$sql);

// $sql = "INSERT INTO `orders_status` (`status_id`, `status_name`) VALUES (NULL, 'rejected')";

// mysqli_query($conn,$sql);




?>