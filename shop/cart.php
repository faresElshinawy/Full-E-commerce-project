<?php
    require_once 'shop/core/user_func.php';
    $p = explode('/',$_SERVER['PHP_SELF']);
    if(!isset($_SESSION['auth']) && !in_array('index.php',$p) ){
        header('location: ../index.php?page=shop');
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
    $page_h1 = 'shopping cart';
    $page_name = 'shopping cart';
    require_once 'inc/page_header_title.php';
    require_once 'shop/core/cart_func.php';
?>



    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <!-- <th>Quantity</th> -->
                            <!-- <th>Total</th> -->
                            <th>Remove</th>
                        </tr>
                    </thead> 
                    <tbody class="align-middle">
                        <?php 
                            $user_id = $_SESSION['auth']['id'];
                            $order_id = get_order_id($conn,$user_id);
                            if($order_id):
                                $total =  total_price($conn,$order_id['order_id']);
                            $result = get_order_items_by_order_id($conn,$order_id['order_id'],$user_id);
                            while($row = mysqli_fetch_assoc($result)): 
                                if(!empty($row['pro_name'])):
                        ?>
                        <tr>
                            <td class="align-middle"><img src="img/product-1.jpg" alt="" style="width: 50px;"><?= $row['pro_name'] ?></td>
                            <td class="align-middle">$<?= $row['price'] ?></td>
                            <td class="align-middle"><a class="btn btn-sm btn-primary" href='shop/handlers/delete_cart_id.php?id=<?= $row['pro_id'] ?>&item_id=<?= $row['order_item_id'] ?>'><i class="fa fa-times"></i></a></td>
                        </tr>
                        <?php endif; ?>
                        <?php endwhile; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart total price</h4>
                    </div>
                    <?php if(isset($total)):  ?>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="text-muted">products count</h5>
                            <h5 class="text-muted"><?= $total['products_count'] ?></h5>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">$<?= $total['total_price'] ?></h5>
                        </div>
                        <?php endif; ?>
                        <a class="btn btn-block btn-primary my-3 py-3" href="shop/handlers/submit_cart.php?order_id=<?= $order_id['order_id'] ?>">Proceed To Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

<?php 
    // include site footer    
    require_once 'inc/site_footer.php'; 
?>