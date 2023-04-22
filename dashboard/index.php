<?php include_once "inc/header.php" ?> 
<?php include_once "inc/sidebar.php" ?>
<?php include_once "inc/topbar.php" ?> 
<?php include_once "core/user_func.php" ?> 


<!-- Page Heading -->
<h1 class="h3 mb-3 text-center text-gray-800">profile</h1>





<div class="container">
<?php if(isset($_SESSION['success'])): ?>

<div class="alert alert-success">
    <?= $_SESSION['success']; ?>
</div>

<?php 

endif; 

unset($_SESSION['success']);

?>
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0 ">
            <!-- Nested Row within Card Body -->
            <div class="row d-flex justify-content-center">
                <div class="col-lg-7">
                    <div class="p-5 d-flex justify-content-between">
                            <div class="form-group d-flex justify-content-center mr-3">
                            <img class=" img-fluid rounded"
                                    src="../uploaded/<?= $_SESSION['auth']['image'] ?>" width = '300' height = '300'>
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
                                        <a type="submit" href='edit_profile.php' class='btn btn-success'>edit profile</a>
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


<?php include_once "inc/footer.php" ?> 