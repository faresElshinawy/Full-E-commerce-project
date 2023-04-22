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
                                <h1 class="h4 text-gray-900 mb-4">add product</h1>
                            </div>
                            <form class="user" method='post' action="handlers/add_product.php" enctype='multipart/form-data'>
                                <?php if(isset($_SESSION['errors']['name'])): ?>
                                        <div class="alert alert-danger">
                                            <?php echo $_SESSION['errors']['name']; ?>
                                        </div>
                                    <?php  endif; ?>
                                <div class="form-group">
                                        <input type="text" class="form-control form-control-user rounded-3 p-4" id="exampleFirstName" name='name'
                                            placeholder="product name">     
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
                                        <input type="number" class="form-control form-control-user rounded-3"
                                            id="exampleInputPassword" placeholder="count" name='count'>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control form-control-user rounded-3"
                                        id="exampleRepeatPassword" placeholder="price" name='price'>
                                    </div>
                                </div>
                                <?php if(isset($_SESSION['errors']['category'])): ?>
                                        <div class="alert alert-danger">
                                            <?php echo $_SESSION['errors']['category']; ?>
                                        </div>
                                    <?php  endif; ?>
                                <div class="form-group">
                                    <select name="category" id=""  class="form-select text-muted" aria-label="Default select example">
                                        <?php
                                        $result = get_categories($conn);
                                        $i = 0;
                                        while($row = mysqli_fetch_assoc($result)):
                                        ?>
                                        <option value="<?= $row['cat_id'] ?>" class='from form-control text-muted ' <?php 
                                            if($i<1){
                                                echo "selected";
                                                $i++;
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
                                    <select name="brand" id=""  class="form-select text-muted" aria-label="Default select example">
                                        <?php
                                        $result = get_brands($conn);
                                        $i = 0;
                                        while($row = mysqli_fetch_assoc($result)):
                                        ?>
                                        <option value="<?= $row['brand_id'] ?>" class='from form-control text-muted ' <?php 
                                            if($i<1){
                                                echo "selected";
                                                $i++;
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
                                        $result = get_colors($conn);
                                        while($row = mysqli_fetch_assoc($result)):
                                        ?>
                                        <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="<?= $row['color_id'] ?>" name = 'colors[]'>
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
                                        <?php if(isset($_SESSION['errors'])):
                                                unset($_SESSION['errors']);
                                        endif;
                                            ?>
    </div>

    <?php include "inc/footer.php" ?> 