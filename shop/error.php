<?php
    // include page header 
    require_once 'inc/site_header.php';
    $p = explode('/',$_SERVER['PHP_SELF']);
    if(!isset($_SESSION['auth']) && !in_array('index.php',$p) ){
        header('location: ../index.php?page=shop');
    }
?>

<div class="container-fluid mt-5">

<!-- 404 Error Text -->
<div class="text-center">
    <div class="error mx-auto" data-text="404">404</div>
    <p class="lead text-gray-800 mb-5">Page Not Found</p>
    <p class="text-gray-500 mb-0">It looks like theres a problem with your request</p>
    <a href="<?= BASE_URL ?>index.php">&larr; Back to home</a>
</div>

</div>