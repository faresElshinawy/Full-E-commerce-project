<?php
    require_once 'shop/core/user_func.php';
    $p = explode('/',$_SERVER['PHP_SELF']);
    if(!isset($_SESSION['auth']) && !in_array('index.php',$p) ){
        header('location: ../index.php?page=login');
    }

?>
<?php
    $page_h1 = 'profile';
    $page_name = 'profile';
    require_once 'inc/page_header_title.php';
    require_once 'core/user_func.php';
?>


<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0 ">
            <!-- Nested Row within Card Body -->
            <div class="row d-flex justify-content-center">
                <div class="col-lg-7">
                    <div class="p-5 d-flex justify-content-between">
                            <div class="form-group d-flex justify-content-center mr-3">
                            <img class=" img-fluid rounded"
                                    src="uploaded/<?= $_SESSION['auth']['image'] ?>" width = '300' height = '300'>
                            </div>
                            <div>
                            <div class="form-group ">
                                    <p>name : <?= $_SESSION['auth']['name'] ?></p>
                            </div>
                            <div class="form-group ">
                                    <p>email : <?= $_SESSION['auth']['email'] ?></p>
                            </div>
                            <div class="form-group ">
                                    <p>address : <?= $_SESSION['auth']['address'] ?></p>
                            </div>
                            <div class="form-group ">
                                    <p>phone : 0<?= $_SESSION['auth']['phone'] ?></p>
                            </div>
                            <div class="form-group ">
                                        <a type="submit" href='index.php?page=edit_user' class='btn btn-dark'>edit profile</a>
                            </div>
                            </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    unset($_SESSION['errors']);
?>