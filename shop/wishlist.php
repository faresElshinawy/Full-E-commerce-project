<?php
    require_once 'shop/core/user_func.php';
    $p = explode('/',$_SERVER['PHP_SELF']);
    if(!isset($_SESSION['auth']) && !in_array('index.php',$p) ){
        header('location: ../index.php?page=login');
    }

?>
<?php
    // include page header 
    require_once 'inc/site_header.php';
    // include page top bar 
    require_once 'inc/site_topbar.php';
    // include page navbar
    require_once 'inc/site_navbar.php';
    // include page title div
    $page_h1 = 'which list';
    $page_name = 'which list';
    require_once 'inc/page_header_title.php';
    require_once 'shop/core/wishlist_func.php';
?>


    <!-- which list Start -->
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">


    <!-- Begin Page Content -->
    <div class="container-fluid ">
        <!-- Content Row -->
        <div class="row">

            <div class="col-xl-12 col-lg-12">

                <!-- Area Chart -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">which list products</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                        <div class="table-responsive">
                                <table class="table  text-center" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th colspan='2'>product</th>
                                            <th>price</th>
                                            <th colspan='2'>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php
                                                $user_id = $_SESSION['auth']['id'];
                                                $result = wish_list_items($conn,$user_id);
                                                if(!empty($result)):
                                                    while($row = mysqli_fetch_assoc($result)):
                                            ?>
                                        <tr>
                                            <td colspan='2'><?= $row['name'] ?></td>
                                            <td>$<?= $row['price'] ?></td>
                                            <td >
                                                <a href="index.php?page=detail&id=<?= $row['pro_id'] ?>&item_id=<?= $row['id'] ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>detail / </a>
                                                <a href="shop/handlers/remove_wishlist_item.php?id=<?= $row['id'] ?>" class='btn btn-sm text-dark p-0'><i class="fa fa-trash text-primary" aria-hidden="true"></i> remove</a>
                                            </td>                                            
                                        </tr>
                                            <?php
                                                    endwhile;
                                                endif;
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- /.container-fluid -->

</div>

</div>
<!-- End of Content Wrapper -->
    <!-- which list  End -->


<?php 
    // include site footer    
    require_once 'inc/site_footer.php'; 
?>