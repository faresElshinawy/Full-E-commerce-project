<?php include_once "inc/header.php" ?> 
<?php include_once "inc/sidebar.php" ?>
<?php include_once "inc/topbar.php" ?> 
<?php include_once "core/product_func.php" ?> 

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
                                <h1 class="h4 text-gray-900 mb-4">add category</h1>
                            </div>
                            <form class="user" method='post' action="handlers/add_category.php" enctype='multipart/form-data'>
                                <?php if(isset($_SESSION['errors']['name'])): ?>
                                        <div class="alert alert-danger">
                                            <?php echo $_SESSION['errors']['name']; ?>
                                        </div>
                                    <?php  endif; ?>
                                <div class="form-group">
                                        <input type="text" class="form-control form-control-user rounded-3 p-4" id="exampleFirstName" name='name'
                                            placeholder="category name">     
                                </div>
                                <?php if(isset($_SESSION['errors']['description'])): ?>
                                        <div class="alert alert-danger">
                                            <?php echo $_SESSION['errors']['description']; ?>
                                        </div>
                                    <?php  endif; ?>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user rounded-3 p-4" id="exampleInputEmail" name='description'
                                        placeholder="description">
                                </div>
                                <?php if(isset($_SESSION['errors']['image'])): ?>
                                        <div class="alert alert-danger">
                                            <?php echo $_SESSION['errors']['image']; ?>
                                        </div>
                                    <?php  endif; ?>
                                    <div class="form-group mb-3">
                                <label for="formFileMultiple" class="form-label text-muted  ">catgory image</label>
                                <input class="form-control text-muted rounded-3"  type="file" id="formFileMultiple" name='image' multiple />
                                </div>
                                <button class='btn btn-primary btn-user btn-block'>submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                                        <?php if(isset($_SESSION['errors'])):
                                                unset($_SESSION['errors']);
                                        endif;
                                            ?>
    </div>

    <?php include "inc/footer.php" ?> 