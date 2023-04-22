<?php include_once "inc/header.php" ?> 
<?php include_once "inc/sidebar.php" ?>
<?php include_once "inc/topbar.php" ?> 
<?php include_once "core/order_func.php" ?> 

<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-3 text-center text-gray-800">order products</h1>

<?php if(isset($_SESSION['success'])): ?>

<div class="alert alert-success">
    <?= $_SESSION['success']; ?>
</div>

<?php 

endif; 

unset($_SESSION['success']);

?>

<?php

if(isset($_GET['id'])):
    if(is_numeric($_GET['id'])):

?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">order products tables</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>name</th>
                        <th>price</th>
                    </tr>
                </thead>
                <tfoot>
                    <td>name</td>
                    <td>price</td>
                </tr>
                </tfoot>
                    <tbody>
                        <?php
                            if(isset($_GET['id'])):
                            $id = sanitize_input($_GET['id']);
                            $data = get_order_items($conn,$id);
                            while($row = mysqli_fetch_assoc($data)):
                        ?>
                            <tr>
                                <td><?= $row['pro_name'] ?></td>
                                <td><?= $row['price'] ?></td>
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

<?php else: ?>

    <div class="container-fluid mt-5">

        <!-- 404 Error Text -->
        <div class="text-center">
            <div class="error mx-auto" data-text="404">404</div>
            <p class="lead text-gray-800 mb-5">wrong request</p>
            <p class="text-gray-500 mb-0">It looks like theres a problem with your request</p>
            <a href="orders.php">&larr; Back to home</a>
        </div>

    </div>
    
<?php        
    endif;
endif;
?>
<?php include_once "inc/footer.php" ?> 