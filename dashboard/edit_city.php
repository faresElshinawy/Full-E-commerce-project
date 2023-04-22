<?php include_once "inc/header.php" ?> 
<?php include_once "inc/sidebar.php" ?>
<?php include_once "inc/topbar.php" ?> 
<?php 

include_once "core/location_func.php" ;
    if(isset($_GET['id'])):
        if(is_numeric($_GET['id'])):
    $id = sanitize_input($_GET['id']);
    $row = get_city_data_by_id($conn,$id);
?> 

    <div class="container">
                    <?php if(isset($_SESSION['errors']['method'])): ?>
                                <div class="alert alert-danger">
                                <?php echo $_SESSION['errors']['method']; ?>
                            </div>
                        <?php  endif; ?>

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">add city</h1>
                            </div>
                            <form class="user" method='post' action="handlers/edit_city.php" enctype='multipart/form-data'>
                                <input type="hidden" name = 'id' value = '<?= $row['city_id'] ?>'>
                                <?php if(isset($_SESSION['errors']['name'])): ?>
                                        <div class="alert alert-danger">
                                            <?php echo $_SESSION['errors']['name']; ?>
                                        </div>
                                    <?php  endif; ?>
                                <div class="form-group">
                                        <input type="text" class="form-control form-control-user rounded-3 p-4" id="exampleFirstName" name='name' value = '<?= $row['city_name'] ?>'
                                            placeholder="city name">     
                                </div>
                                <button class='btn btn-primary btn-user btn-block'>submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>

                <div class="container-fluid mt-5">

                    <!-- 404 Error Text -->
                    <div class="text-center">
                        <div class="error mx-auto" data-text="404">404</div>
                        <p class="lead text-gray-800 mb-5">wrong request</p>
                        <p class="text-gray-500 mb-0">It looks like theres a problem with your request</p>
                        <a href="locations.php">&larr; Back to home</a>
                    </div>

                </div>
                    
        <?php        
            endif;
        endif;
        ?>
                                        <?php if(isset($_SESSION['errors'])):
                                                unset($_SESSION['errors']);
                                        endif;
                                            ?>
    </div>

    <?php include "inc/footer.php" ?> 