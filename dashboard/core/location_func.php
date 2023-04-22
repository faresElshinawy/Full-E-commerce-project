<?php

    // get cities function

    function get_cities($conn){
        $sql = "SELECT * FROM cities";
        $result = mysqli_query($conn,$sql);
        return $result;
    }


    // delete city function

    function delete_city($conn,$id){
        $sql = "DELETE FROM cities WHERE city_id = '$id'";
        mysqli_query($conn,$sql);
    }

        // check city unique name

        function check_unique_city_name($conn,$name){
            $sql = "SELECT city_id , city_name FROM cities";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){
                if($row['city_name'] == $name){
                    return true ;
                }
            }
            return false ;
        }

    // check city unique name

    function check_unique_city_name_edit($conn,$name,$id){
        $sql = "SELECT city_id , city_name FROM cities WHERE city_id <> '$id'";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            if($row['city_name'] == $name){
                return true ;
            }
        }
        return false ;
    }

    // insert new city function

    function new_city($conn,$name){
        $sql = "INSERT INTO cities (`city_name`) values ('$name')";
        mysqli_query($conn,$sql);
    }

    // get city data by id function

    function get_city_data_by_id($conn,$id){
        $sql = "SELECT * FROM cities WHERE city_id = '$id'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        return $row ;
    }

    // update city data function

    function update_city($conn,$name,$id){
        $sql = "UPDATE cities SET city_name = '$name' WHERE city_id = '$id'";
        mysqli_query($conn,$sql);
    }