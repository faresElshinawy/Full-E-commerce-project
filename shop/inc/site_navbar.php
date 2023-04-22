    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">brands <i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                            <?php 
                            $result = get_brands($conn);
                            while($row = mysqli_fetch_assoc($result)):
                            ?>
                                <a href="index.php?page=shop&brand_id=<?= $row['brand_id'] ?>" class="dropdown-item"><?= $row['brand_name'] ?></a>
                            <?php endwhile ; ?>
                            </div>
                        </div>
                        <?php 
                            $result = get_categories($conn);
                            while($row = mysqli_fetch_assoc($result)):
                        ?>
                        <a href="index.php?page=shop&cat_id=<?= $row['cat_id'] ?>" class="nav-item nav-link"><?= $row['cat name'] ?></a>
                        <?php endwhile ; ?>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link <?php
                                if(!isset($_GET['page'])){
                                    echo 'active';
                                }
                            ?>">Home</a>
                            <a href="index.php?page=shop" class="nav-item nav-link <?php
                                if(isset($_GET['page']) && $_GET['page'] == 'shop'){
                                    echo 'active';
                                }
                            ?>">Shop</a>
                            <?php if(isset($_SESSION['auth'])): ?>
                            <a href="index.php?page=contact" class="nav-item nav-link <?php
                                if(isset($_GET['page']) && $_GET['page'] == 'contact'){
                                    echo 'active';
                                }
                            ?>">Contact</a>
                                <a href="index.php?page=profile" class="nav-item nav-link    <?php
                                if(isset($_GET['page']) && $_GET['page'] == 'profile'){
                                    echo 'active';
                                }
                            ?>">profile</a>
                            <?php
                        endif;
                        ?>
                        </div>
                        <?php
                        if(!isset($_SESSION['auth'])):
                        ?>
                        
                        <div class="navbar-nav ml-auto py-0">
                            <a href="index.php?page=login" class="nav-item nav-link <?php
                                if(isset($_GET['page']) && $_GET['page'] == 'login'){
                                    echo 'active';
                                }
                            ?>">Login</a>
                            <a href="index.php?page=register" class="nav-item nav-link    <?php
                                if(isset($_GET['page']) && $_GET['page'] == 'register'){
                                    echo 'active';
                                }
                            ?>">Register</a>
                        </div>
                        <?php else: ?>

                        <?php if($_SESSION['auth']['permission'] == 'admin' || $_SESSION['auth']['permission'] == 'employee'):?>

                        <a href="dashboard/index.php" class="nav-item nav-link">dashboard</a>

                        <?php endif; ?>

                            <a href="shop/handlers/logout.php" class="nav-item nav-link">logout</a>

                        <?php endif; ?>

                    </div>
                </nav>
                <!-- start slider condition -->
                <?php 
                if(!isset($_GET['page']) && !isset($_GET['search'])):
                ?>
                <!-- shop slider -->
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                    <?php
                        $result = get_brands_limit($conn);
                        $i = 0;
                        while($row = mysqli_fetch_assoc($result)):
                            if($i != '1'):
                                $i++;
                    ?>
                        <div class="carousel-item active" style="height: 410px;">
                            <img class="img-fluid" src="uploaded/<?= $row['brand_image'] ?>" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3"><?= $row['brand_name'] ?></h4>
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4"><?= $row['brand_description'] ?></h3>
                                    <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                                </div>
                            </div>
                        </div>
                                <?php else: ?>
                        <div class="carousel-item" style="height: 410px;">
                            <img class="img-fluid" src="uploaded/<?= $row['brand_image'] ?>" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3"><?= $row['brand_name'] ?></h4>
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4"><?= $row['brand_description'] ?></h3>
                                    <a href="" class="btn btn-light py-2 px-3">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <?php
                        endif;
                        endwhile;
                    ?>
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
                <?php
                endif;
                ?>
                <!-- end slider condition -->
            </div>
        </div>
    </div>
    <!-- Navbar End -->
    