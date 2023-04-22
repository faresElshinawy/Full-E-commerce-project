<?php
    require_once 'shop/core/user_func.php';
    $p = explode('/',$_SERVER['PHP_SELF']);
    if(!isset($_SESSION['auth']) && !in_array('index.php',$p) ){
        header('location: ../index.php?page=login');
    }
?>
<?php
    $page_h1 = 'order items';
    $page_name = 'order items';
    require_once 'inc/page_header_title.php';
    require_once 'shop/core/order_func.php';
    ?>
    <div class="container-fluid">

<!-- DataTales Example -->
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
                                $data = get_order_items_by_order_id_only($conn,$id);
                                if(!empty($data)):
                            while($row = mysqli_fetch_assoc($data)):
                        ?>
                            <tr>
                                <td><?= $row['pro_name'] ?></td>
                                <td>$<?= $row['price'] ?></td>
                            </tr>
                            <?php endwhile; ?>
                            <?php endif; ?>
                            <?php endif; ?>
                </tbody>
            </table>
</div>

</div>