<?php include_once "inc/header.php" ?> 
<?php include_once "inc/sidebar.php" ?>
<?php include_once "inc/topbar.php" ?> 
<?php include_once "core/user_func.php" ?> 
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-3 text-center text-gray-800">users</h1>


<?php 
                if(isset($_GET['id'])):
                    if(is_numeric($_GET['id'])):
?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">users tables</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>name</th>
                        <th>order id</th>
                        <th>status</th>
                        <th>address</th>
                        <th>products count</th>
                        <th>total price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $id = sanitize_input($_GET['id']);
                    $result = user_orders($conn,$id);
                    while($row = mysqli_fetch_assoc($result)):
                        ?>
                    <tr>
                        <td><?= $row['first_name'] . ' ' . $row['last_name'] ?></td>
                        <td><?= $row['order_id'] ?></td>
                        <td
                        
                        class = '
                        <?php if($row['status_name'] == 'unconfirmed'){
                                    echo "text-info";
                                }elseif($row['status_name'] == 'delivered'){
                                    echo "text-success";
                                }elseif($row['status_name'] == 'rejected'){
                                    echo "text-danger";
                                }
                        ?>
                        '

                        ><?= $row['status_name'] ?></td>
                        <td><?= $row['del_address'] ?></td>
                        <td><?= $row['products_count'] ?></td>
                        <td>$<?= $row['total_price'] ?></td>
                </tr>
                        <?php 
                                endwhile;
                        ?>

                </tbody>
            </table>
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
                                <a href="users.php">&larr; Back to home</a>
                            </div>

                        </div>
                            
                        <?php        
                            endif;
                        endif;
                        ?>

</div> 
<?php include_once "inc/footer.php" ?> 