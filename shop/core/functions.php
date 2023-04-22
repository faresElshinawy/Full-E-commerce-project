<?php

// redirect function

function redirect($path){
    header("location:" . $path);
    die;
} 