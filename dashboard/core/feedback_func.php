<?php

// get feedback function

function get_feedbacks($conn){
    $sql = "SELECT feedbacks.user_id ,  feedback_id as id , first_name , last_name  , email , message  FROM users INNER JOIN feedbacks WHERE users.user_id = feedbacks.user_id";
    $result = mysqli_query($conn,$sql);
    return $result ;
}

// delete feedback function

function delete_feedback($conn,$id){
    $sql = "DELETE FROM feedbacks WHERE feedback_id = '$id'";
    mysqli_query($conn,$sql);
}