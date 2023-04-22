<?php include_once "inc/header.php" ?> 
<?php include_once "inc/sidebar.php" ?>
<?php include_once "inc/topbar.php" ?> 
<?php include_once "core/category_func.php" ?> 

    <div class="container">
                    <?php if(isset($_SESSION['errors']['method'])): ?>
                                <div class="alert alert-danger">
                                <?php echo $_SESSION['errors']['method']; ?>
                            </div>
                        <?php  endif;
            if(isset($_GET['id'])):
                if(is_numeric($_GET['id'])):
                    $id = sanitize_input($_GET['id']);
                    $row = get_category_by_id($conn,$id);
            ?>

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">edit category</h1>
                            </div>
                            <form class="user" method='post' action="handlers/edit_category.php" enctype='multipart/form-data'>
                                <input type="hidden" value = "<?= $row['cat_id'] ?>" name = 'id'>
                                <?php if(isset($_SESSION['errors']['name'])): ?>
                                        <div class="alert alert-danger">
                                            <?php echo $_SESSION['errors']['name']; ?>
                                        </div>
                                    <?php  endif; ?>
                                <div class="form-group">
                                        <input type="text" class="form-control form-control-user rounded-3 p-4" id="exampleFirstName" name='name' value = "<?= $row['cat name'] ?>"
                                            placeholder="category name">     
                                </div>
                                <?php if(isset($_SESSION['errors']['description'])): ?>
                                        <div class="alert alert-danger">
                                            <?php echo $_SESSION['errors']['description']; ?>
                                        </div>
                                    <?php  endif; ?>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user rounded-3 p-4" id="exampleInputEmail" name='description' value = "<?= $row['cat_description'] ?>"
                                        placeholder="description">
                                </div>
                                <?php if(isset($_SESSION['errors']['image'])): ?>
                                        <div class="alert alert-danger">
                                            <?php echo $_SESSION['errors']['image']; ?>
                                        </div>
                                    <?php  endif; ?>
                                    <div class="form-group mb-3">
                                        <img src = '../uploaded/<?= $row['cat_image'] ?>' class='img-fluid'>
                                        <input type='hidden' value = '<?= $row['cat_image'] ?>' name = 'old_image'>
                                    </div>
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
        <?php else: ?>

            <div class="container-fluid mt-5">

                <!-- 404 Error Text -->
                <div class="text-center">
                    <div class="error mx-auto" data-text="404">404</div>
                    <p class="lead text-gray-800 mb-5">wrong request</p>
                    <p class="text-gray-500 mb-0">It looks like theres a problem with your request</p>
                    <a href="categories.php">&larr; Back to home</a>
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