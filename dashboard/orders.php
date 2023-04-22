<?php include_once "inc/header.php" ?> 
<?php include_once "inc/sidebar.php" ?>
<?php include_once "inc/topbar.php" ?> 
<?php include_once "core/order_func.php" ?> 

<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-3 text-center text-gray-800">orders</h1>

<?php if(isset($_SESSION['success'])): ?>

<div class="alert alert-success">
    <?= $_SESSION['success']; ?>
</div>

<?php 

endif; 

unset($_SESSION['success']);

?>

<?php 
if(isset($_SESSION['errors'])):
    foreach($_SESSION['errors'] as $error):

?>

<div class="alert alert-danger">
    <?= $error ?>
</div>

<?php 

    endforeach;
endif; 

unset($_SESSION['errors']);

?>
<!-- <div class="border-bottom mb-4 pb-4 col-2">
                    <h5 class="font-weight-semi-bold mb-4 text-primary">Filter by status</h5>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                filters
                            </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse hide" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                        <div class="form-group mb-3 ">
                                            <a href="orders.php?status=1" class = "form-control text-decoration-none">unconfirmed</a>
                                        </div>
                                        <div class="form-group mb-3 ">
                                            <a href="orders.php?status=2" class = "form-control text-decoration-none">under processing</a>
                                        </div>
                                        <div class="form-group mb-3 ">
                                            <a href="orders.php?status=3" class = "form-control text-decoration-none">delivered</a>
                                        </div>
                                        <div class="form-group mb-3 ">
                                            <a href="orders.php?status=4" class = "form-control text-decoration-none">rejected</a>
                                        </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">orders tables</h6>
    </div>
    <div class="card-body">
        <!-- <div class="table-responsive"> -->
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>address</th>
                        <th>status</th>
                        <th>created at</th>
                        <th>products count</th>
                        <th>total price</th>
                        <th>control</th>
                    </tr>
                </thead>
                <tfoot>
                        <td>id</td>
                        <td>name</td>
                        <td>address</td>
                        <td>status</td>
                        <td>created at</td>
                        <td>products count</td>
                        <td>created at</td>
                        <td>control</td>
                </tr>
                </tfoot>
                    <tbody>
                        <?php
                            if(isset($_GET['status'])){
                                $status_id = sanitize_input($_GET['status']);
                                $data = get_orders_by_status($conn,$status_id);
                            }else{
                                $data = get_orders($conn);
                            }
                                while($row = mysqli_fetch_assoc($data)):
                        ?>
                            <tr>
                                <td><?= $row['order_id'] ?></td>
                                <td><?= $row['first_name'] . ' ' . $row['last_name'] ?></td>
                                <td>
                                    <?= $row['del_address'] ?>
                                </td>
                                <td

                                class = '
                                    <?php if($row['status_name'] == 'unconfirmed'){
                                                echo "text-primary";
                                            }elseif($row['status_name'] == 'delivered'){
                                                echo "text-success";
                                            }elseif($row['status_name'] == 'rejected'){
                                                echo "text-danger";
                                            }
                                    ?>
                                    '
                                >
                                    <?= $row['status_name'] ?>
                                </td>
                                <td><?= $row['created_at'] ?></td>
                                <td><?= $row['products_count'] ?></td>
                                <td>$<?= $row['total_price'] ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                        <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                                        <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                                        </svg>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <?php if($row['status_name'] != 'delivered' && $row['status_name'] != 'unconfirmed' && $row['status_name'] != 'rejected'): ?>
                                            <li>
                                                <a class="dropdown-item" href="handlers/submit_order.php?order_id=<?= $row['order_id'] ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-square" viewBox="0 0 16 16">
                                                <path class='text-success' d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z"/>
                                                <path class='text-success' d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                                                </svg>
                                                </a>
                                            </li>
                                            <?php endif; ?>
                                            <li>
                                                <a class="dropdown-item" href="show_order_products.php?id=<?= $row['order_id'] ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-square" viewBox="0 0 16 16">
                                                <path class = 'text-info' d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                                <path class = 'text-info' d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                </svg>
                                                </a>
                                            </li>
                                            <?php if($row['status_name'] != 'delivered' && $row['status_name'] != 'unconfirmed'): ?>
                                                <?php if($row['status_name'] != 'rejected'): ?>
                                            <li>
                                                <a class="dropdown-item" href="handlers/reject_order.php?id=<?= $row['order_id'] ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                                                <path class = 'text-warning' d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                                <path class = 'text-warning'  d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                </svg>
                                                </a>
                                            </li>
                                                    <?php endif; ?>
                                            <li>
                                                <a class="dropdown-item" href="handlers/delete_order.php?id=<?= $row['order_id'] ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path class = 'text-danger' d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                <path class = 'text-danger' d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                                </svg>
                                                </a>
                                            </li>
                                            <?php endif; ?>
                                            <li>
                                                <a class="dropdown-item" target='_blank' href="../pdf_gen/new_pdf.php?id=<?= $row['order_id'] ?>&gen_pdf=yes">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                                <path class='text-muted' d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                                <path class='text-muted'  d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                                                </svg>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                </tbody>
            </table>
        <!-- </div> -->
    </div>
</div>

</div>
<?php include_once "inc/footer.php" ?> 