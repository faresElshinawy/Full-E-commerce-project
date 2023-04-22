<?php
    require_once  "database/conn.php";
    require_once  "shop/core/validation.php";
    require_once  "shop/core/functions.php";
    require_once  "shop/core/home_func.php";
    require_once 'shop/inc/site_header.php';


        if(isset($_SESSION['success'])):
        
?>
        
        <!-- <div class='container-fluid'></div> -->
        <div class="alert alert-success">
            <?= $_SESSION['success']; ?>
        </div>

<?php
        unset($_SESSION['success']);
        
        endif; 

?>

<?php
        if(isset($_SESSION['errors'])):
?>
                    
                    <!-- <div class='container-fluid'></div> -->
<?php 
                    if(isset($_GET['page']) && $_GET['page'] != 'register'):
                        foreach($_SESSION['errors'] as $error):

?>
                            <div class="alert alert-danger">
                                <?php  echo $error;  ?>
                            </div>
<?php

                        endforeach;
                        ?>
            
            <?php
                    unset($_SESSION['errors']);
                    
                endif; 
            endif;


    require_once 'shop/inc/site_topbar.php';
    require_once 'shop/inc/site_navbar.php';

?>
    

<?php 
    if(!isset($_GET['page']) && !isset($_GET['search'])){
        require_once 'shop/home.php';
    }elseif(isset($_GET['page']) && $_GET['page'] == 'shop'){
        require_once 'shop/shop.php';
    }elseif(isset($_GET['page']) && $_GET['page'] == 'contact'){
        require_once 'shop/contact.php';
    }elseif(isset($_GET['page']) && $_GET['page'] == 'login' && !isset($_SESSION['auth'])){
        require_once 'shop/login.php';
    }elseif(isset($_GET['page']) && $_GET['page'] == 'register'){
        require_once 'shop/register.php';
    }elseif(isset($_GET['page']) && $_GET['page'] == 'detail'){
            require_once 'shop/detail.php';
    }elseif(isset($_SESSION['auth']) && isset($_GET['page']) && $_GET['page'] == 'profile'){
        require_once 'shop/profile.php';
    }elseif(isset($_SESSION['auth']) && isset($_GET['page']) && $_GET['page'] == 'wishlist'){
        require_once 'shop/wishlist.php';
    }elseif(isset($_SESSION['auth']) && isset($_GET['page']) && $_GET['page'] == 'cart'){
        require_once 'shop/cart.php';
    }elseif(isset($_GET['search']) && $_GET['search'] == 'search'){
        require_once 'shop/shop.php';
    }elseif(isset($_GET['page']) && $_GET['page'] == 'edit_user'){
        require_once 'shop/edit_user.php';
    }elseif(isset($_GET['page']) && $_GET['page'] == 'order_history'){
        require_once 'shop/order_history.php';
    }elseif(isset($_GET['page']) && $_GET['page'] == 'order_items'){
        require_once 'shop/order_items.php';
    }
?>

<?php

require_once 'shop/inc/site_footer.php';

?>