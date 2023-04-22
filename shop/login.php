<?php
    // include page title div
    $page_h1 = 'login';
    $page_name = 'login';
    require_once 'inc/page_header_title.php';
    $p = explode('/',$_SERVER['PHP_SELF']);
    if(!isset($_SESSION['auth']) && !in_array('index.php',$p) ){
        header('location: ../index.php?page=shop');
    }
?>



<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                            </div>
                            <form class="user" action = 'shop/handlers/handle_login.php' method = 'POST'>
                            <?php if(isset($_SESSION['success'])): ?>
                                    <div class="alert alert-success">
                                        <?php echo $_SESSION['success']; ?>
                                    </div>
                                <?php  endif; ?>
                                <?php if(isset($_SESSION['errors']['wrong'])): ?>
                                    <div class="alert alert-danger">
                                        <?= $_SESSION['errors']['wrong']; ?>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(isset($_SESSION['errors']['email'])): ?>
                                    <div class="alert alert-danger">
                                        <?= $_SESSION['errors']['email']; ?>
                                    </div>
                                    <?php endif; ?>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name = 'email'
                                        id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Enter Email Address...">
                                </div>
                                <?php if(isset($_SESSION['errors']['password'])): ?>
                                    <div class="alert alert-danger">
                                        <?= $_SESSION['errors']['password']; ?>
                                    </div>
                                    <?php endif; ?>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name = 'password'
                                        id="exampleInputPassword" placeholder="Password">
                                </div>
                                <button class="btn btn-primary btn-user btn-block">submit</button>
                            </form>
                            <?php 
                            unset($_SESSION['errors']);
                            unset($_SESSION['success']);
                            ?>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="index.php?page=register">Create an Account!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</div>

