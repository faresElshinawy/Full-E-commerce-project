    <?php 
    
    $p = explode('/',$_SERVER['PHP_SELF']);
    if(!isset($_SESSION['auth']) && !in_array('index.php',$p) ){
        header('location: ../index.php?page=shop');
    }
    
    ?>
    <!-- include shop side bar -->

    <?php require_once 'inc/site_sidebar.php'; ?>
    <?php require_once 'core/shop_func.php'; ?>

            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <!-- shop search and sorting -->
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="index.php?search=search" method='post'>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search by name" name='name'>
                        <!-- <div class="input-group-append"> -->
                            <span class=" bg-transparent text-primary border-bottom ml-1">
                            <button type='submit' class='btn btn-primary rounded'><i class="fa fa-search"></i></button>
                            </span>
                        <!-- </div> -->
                                </div>
                            </form>
                            <!-- sort drop down -->
                            <!-- <div class="dropdown ml-4">
                                <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                            Sort by
                                        </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                    <a class="dropdown-item" href="#">Latest</a>
                                    <a class="dropdown-item" href="#">Popularity</a>
                                    <a class="dropdown-item" href="#">Best Rating</a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <!-- products card -->
                        <?php 
                            if(!isset($_GET['price']) && !isset($_GET['date']) && !isset($_GET['search']) && !isset($_GET['cat_id']) && !isset($_GET['brand_id']) && !isset($_GET['most_selling'])){
                            $result = get_products($conn);
                            }elseif(isset($_GET['price']) && $_GET['price'] == 'max'){
                            $result = get_products_max($conn);
                            }elseif(isset($_GET['price']) && $_GET['price'] == 'min'){
                                $result = get_products_min($conn);
                            }elseif(isset($_GET['price']) && $_GET['price'] != 'min' && $_GET['price'] != 'max'){
                                $result = get_products($conn);
                            }elseif(isset($_GET['date']) && $_GET['date'] == 'latest'){
                                $result = get_products_latest($conn);
                            }elseif(isset($_GET['date']) && $_GET['date'] != 'latest'){
                                $result = get_products($conn);
                            }elseif(isset($_POST['name'])){
                                $name = sanitize_input($_POST['name']);
                                $result = get_search($conn,$name);
                            }elseif(isset($_GET['cat_id'])){
                                $cat_id = sanitize_input($_GET['cat_id']);
                                $result = get_category_products($conn,$cat_id);
                            }elseif(isset($_GET['brand_id'])){
                                $brand_id = sanitize_input($_GET['brand_id']);
                                $result = get_brand_products($conn,$brand_id);
                            }elseif(isset($_GET['most_selling'])){
                                $result = get_products_most_selling($conn);
                            }
                                while($row = mysqli_fetch_assoc($result)):
                        ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                        <div class="card product-item border-0 mb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-100" src="uploaded/<?= $row['image'] ?>" alt="">
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3"><?= $row['name'] ?></h6>
                                <div class="d-flex justify-content-center">
                                    <h6>$<?= $row['price'] ?></h6>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="index.php?page=detail&id=<?= $row['id'] ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                <?php if(isset($_SESSION['auth'])): ?>
                                    <a href="shop/handlers/add_to_wishlist.php?id=<?= $row['id'] ?>" class="btn btn-sm text-dark p-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                                            <path class='text-primary' d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"/>
                                        </svg>
                                    </a>
                                    <?php else: ?>
                                <a href="index.php?page=login" class="btn btn-sm text-dark p-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                                    <path class='text-primary' d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"/>
                                    </svg>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <!-- <div class="col-12 pb-1">
                        <nav aria-label="Page navigation">
                          <ul class="pagination justify-content-center mb-3">
                            <li class="page-item disabled">
                              <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                              </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                              <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                              </a>
                            </li>
                          </ul>
                        </nav>
                    </div> -->
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

    