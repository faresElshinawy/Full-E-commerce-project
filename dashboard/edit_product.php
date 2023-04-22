<?php include_once "inc/header.php" ?> 
<?php include_once "inc/sidebar.php" ?>
<?php include_once "inc/topbar.php" ?> 
<?php include_once "core/product_func.php" ?> 
<?php 
if(isset($_GET['id'])):
    if(is_numeric($_GET['id'])):
        $id = sanitize_input($_GET['id']) ;
        $product = get_product_by_id($conn,$id);
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
                                <h1 class="h4 text-gray-900 mb-4">edit product</h1>
                            </div>
                            <form class="user" method='post' action="handlers/edit_product.php" enctype='multipart/form-data'>
                                <input type="hidden" value="<?= $id ?>" name='id'>
                                <?php if(isset($_SESSION['errors']['name'])): ?>
                                        <div class="alert alert-danger">
                                            <?php echo $_SESSION['errors']['name']; ?>
                                        </div>
                                    <?php  endif; ?>
                                <div class="form-group">
                                        <input type="text" class="form-control form-control-user rounded-3 p-4" id="exampleFirstName" name='name' value = '<?= $product['pro_name'] ?>'
                                            placeholder="product name">     
                                </div>
                                <?php if(isset($_SESSION['errors']['description'])): ?>
                                        <div class="alert alert-danger">
                                            <?php echo $_SESSION['errors']['description']; ?>
                                        </div>
                                    <?php  endif; ?>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user rounded-3 p-4" id="exampleInputEmail" name='description' value = '<?= $product['description'] ?>'
                                        placeholder="description">
                                </div>
                                <?php if(isset($_SESSION['errors']['image'])): ?>
                                        <div class="alert alert-danger">
                                            <?php echo $_SESSION['errors']['image']; ?>
                                        </div>
                                    <?php  endif; ?>
                                    <div class="form-group mb-3">
                                        <img src = '../uploaded/<?= $product['image'] ?>' class='img-fluid'>
                                        <input type='hidden' value = '<?= $product['image'] ?>' name = 'old_image'>
                                    </div>
                                    <div class="form-group mb-3">
                                <label for="formFileMultiple" class="form-label text-muted  ">product image</label>
                                <input class="form-control text-muted rounded-3"  type="file" id="formFileMultiple" name='image' multiple />
                                </div>
                                <?php if(isset($_SESSION['errors']['count'])): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $_SESSION['errors']['count']; ?>
                                    </div>
                                <?php  endif; ?>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0 ">
                                        <input type="number" class="form-control form-control-user rounded-3" value = '<?= $product['count'] ?>'
                                            id="exampleInputPassword" placeholder="count" name='count'> 
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control form-control-user rounded-3" value = '<?= $product['price'] ?>'
                                        id="exampleRepeatPassword" placeholder="price" name='price'>
                                    </div>
                                </div>
                                <?php if(isset($_SESSION['errors']['category'])): ?>
                                        <div class="alert alert-danger">
                                            <?php echo $_SESSION['errors']['category']; ?>
                                        </div>
                                    <?php  endif; ?>
                                <div class="form-group">
                                    <label for="category" class='text-muted'>choose category</label>
                                    <select name="category" id="category"  class="form-select text-muted" aria-label="Default select example">
                                        <?php
                                        $result = get_categories($conn);
                                        while($row = mysqli_fetch_assoc($result)):
                                        ?>
                                        <option value="<?= $row['cat_id'] ?>" class='from form-control text-muted ' <?php 
                                            if($row['cat_id'] == $product['cate_id']){
                                                echo "selected";
                                            }
                                        ?>><?= $row['cat name'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <?php if(isset($_SESSION['errors']['brand'])): ?>
                                        <div class="alert alert-danger">
                                            <?php echo $_SESSION['errors']['brand']; ?>
                                        </div>
                                    <?php  endif; ?>
                                <div class="form-group">
                                <label for="brand" class='text-muted'>choose brand</label>
                                    <select name="brand" id="brand"  class="form-select text-muted" aria-label="Default select example">
                                        <?php
                                        $result = get_brands($conn);
                                        $i = 0;
                                        while($row = mysqli_fetch_assoc($result)):
                                        ?>
                                        <option value="<?= $row['brand_id'] ?>" class='from form-control text-muted ' <?php 
                                            if($row['brand_id'] == $product['brand_id']){
                                                echo "selected";
                                            }
                                        ?>><?= $row['brand_name'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <?php if(isset($_SESSION['errors']['colors'])): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $_SESSION['errors']['colors']; ?>
                                    </div>
                                <?php  endif; ?>
                                    <div class="form-group">
                                        <?php
                                        $result = edit_product_color($conn,$id);
                                        while($row = mysqli_fetch_assoc($result)):
                                        ?>
                                        <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="<?= $row['color_id'] ?>" name = 'colors[]'
                                                <?php
                                                    if($row['pro_id'] == $product['pro_id']){
                                                        echo 'checked';
                                                    }
                                                ?>
                                                >
                                                <label class="form-check-label" for="inlineCheckbox1"><?= $row['color_name'] ?></label>
                                                </div>
                                                <?php endwhile; ?>
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
                <a href="products.php">&larr; Back to home</a>
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