<?php 

// host name
const HOST = 'localhost';

// user name
const USER = 'root';

// user password 
const PASSWORD = '';

// database name
const DB_NAME = 'pix';

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
