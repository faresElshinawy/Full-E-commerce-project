<?php

// add new message function

function new_message($conn,$user_id,$message){
    $sql = "INSERT INTO feedbacks(`user_id`,`message`) VALUES ('$user_id','$message')";
    mysqli_query($conn,$sql);
}