<?php


// get colors function

function get_colors($conn){
    $sql = "SELECT * FROM colors";
    $result = mysqli_query($conn,$sql);
    return $result ;
}

// check unique color name function

function check_unique_color_name($conn,$name){
    $sql = 'SELECT * FROM colors';
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        if($row['color_name'] == $name){
            return true ;
        }
    }
    return false;
}

// unsert new color function

function new_color($conn,$name){
    $sql = "INSERT INTO colors(color_name) VALUES ('$name')";
    mysqli_query($conn,$sql);
}

// get color info by id function

function get_color_info_by_id($conn,$id){
    $sql = "SELECT * FROM colors WHERE color_id = '$id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    return $row ;
}

// check unique color name function

function check_unique_color_name_edit($conn,$name,$id){
    $sql = "SELECT * FROM colors WHERE color_id <> '$id'";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        if($row['color_name'] == $name){
            return true;
        }
    }
    return false;
}

// update color info function

function update_color($conn,$name,$id){
    $sql = "UPDATE colors SET color_name = '$name' WHERE color_id = '$id'";
    mysqli_query($conn,$sql);
}

// delete color by id function

function delete_color($conn,$id){
    $sql = "DELETE FROM colors WHERE color_id = '$id'";
    mysqli_query($conn,$sql);
}