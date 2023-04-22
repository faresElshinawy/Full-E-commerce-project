<?php
    // include page title div
    $page_h1 = 'product detail';
    $page_name = 'product detail';
    require_once 'inc/page_header_title.php';
    require_once 'shop/core/detail_func.php';
    require_once 'shop/core/pro_comment_func.php';
    $p = explode('/',$_SERVER['PHP_SELF']);
    if(!isset($_SESSION['auth']) && !in_array('index.php',$p) ){
        header('location: ../index.php?page=shop');
    }
?>



    <!-- Shop Detail Start -->
    <?php

if(isset($_GET['id'])):
    if(is_numeric($_GET['id'])):
    $id = sanitize_input($_GET['id']);
    $row = get_product_details($conn,$id);
    $product_id = $row['id'];
    $result = get_product_colors($conn,$id);
    $i = 0;
?>
    <div class="container-fluid py-5">
        <div class="row px-xl-5 justify-content-center">
            <div class="col-lg-5 pb-5">
                <div id="product-carouse" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="uploaded/<?= $row['image'] ?>" alt="Image">
                        </div>
                    </div>
                    <!-- <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a> -->
                </div>
            </div>
            <div class="col-lg-7 pb-5">
                            <h3 class="font-weight-semi-bold"><?= $row['name'] ?></h3>
                            <div class="d-flex mb-3">   
                                <!-- <small class="pt-1">(50 Reviews)</small> -->
                            </div>
                            <h3 class="font-weight-semi-bold mb-4"><?= $row['price'] ?></h3>
                            <p class="mb-4"><?= $row['description'] ?>.</p>
                            <div class="d-flex mb-4">
                                <p class="text-dark font-weight-medium mb-0 mr-3">Colors:</p>
                                <form action = 'shop/handlers/add_to_cart.php' method='post'>
                <?php 
                    while($colors = mysqli_fetch_assoc($result)):
                ?>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="color-<?= $i ?>" value='<?= $colors['color_id'] ?>' name="color">
                            <input type="hidden" value='<?= $row['id'] ?>' name="id">
                            <?php if(isset($_GET['item_id'])): ?>
                            <input type="hidden" value='<?= sanitize_input($_GET['item_id']) ?>' name="item_id">
                            <?php endif; ?>
                            <label class="custom-control-label" for="color-<?= $i ?>"><?= $colors['color_name'] ?></label>
                        </div>
                <?php 
                        $i++;
                    endwhile;
                ?>
                    <!-- <div class="d-flex align-items-center mb-4 pt-2"> -->
                        <div class="p-3">
                            <?php if(isset($_SESSION['auth'])): ?>
                                <button class="btn btn-primary px-3" type='submit' href='handlers/add_to_cart.php'><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                            <?php else: ?>
                                <a class="btn btn-primary px-3" href='index.php?page=login'><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</a>
                            <?php endif; ?>
                        </div>
                    <!-- </div> -->
                    </form>
                </div>
                <div class="d-flex pt-2">
                    <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php
            $reviews_count = reviews_count($conn,$id);
        ?>

        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Reviews (<?= $reviews_count['count'] ?>)</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                    <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4 "><?= $reviews_count['count'] ?> reviews</h4>

                                <?php
                                    $result = get_product_comment($conn,$id);
                                    while($row = mysqli_fetch_assoc($result)):
                                ?>

                                <div class="media mb-4">
                                    <img src="uploaded/<?= $row['image'] ?>" alt="Image" class="img-fluid mr-3 mt-1 rounded" style="width: 45px;">
                                    <div class="media-body">
                                        <h6 class = 'text-primary'><?= $row['first_name'] , ' ' , $row['last_name'] ?>
                                            <?php 
                                                if(isset($_SESSION['auth'])):
                                                    if($_SESSION['auth']['permission'] == 'admin' || $row['user_id'] == $_SESSION['auth']['id'] ):
                                                ?>
                                                        <a href="shop/handlers/delete_comment.php?product_id=<?= $row['pro_id'] ?>&comment=<?= $row['product_review_id'] ?>" class='btn btn-sm comment-delete-button'><span class='text-danger'>delete</span></a>
                                            <?php 
                                                    endif;
                                                endif;
                                                ?>
                                    </h6>
                                        <p><?= $row['comment'] ?></p>
                                    </div>
                                </div>

                                <?php endwhile; ?>

                            </div>
                            <div class="col-md-6">
                                <h4 class="mb-4">Leave a review</h4>
                                <form method = 'POST' action = 'shop/handlers/add_pro_comment.php'>
                                    <div class="form-group">
                                        <label for="message">Your Review *</label>
                                        <textarea id="message" cols="30" rows="5" class="form-control" name='comment'></textarea>
                                        <input type="hidden" value="<?= $product_id ?>" name='product_id'>
                                    </div>  
                                    <div class="form-group mb-0">
                                        <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    </div>

                    <div class="tab-pane fade" id="tab-pane-3">
                        
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
                    <a href="index.php">&larr; Back to home</a>
                </div>

        </div>

    <?php endif; ?>
<?php endif; ?>
    <!-- Shop Detail End -->



