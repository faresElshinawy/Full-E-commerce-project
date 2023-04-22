<?php include_once "inc/header.php" ?> 
<?php include_once "inc/sidebar.php" ?>
<?php include_once "inc/topbar.php" ?> 
<?php include_once "core/feedback_func.php" ?> 

<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-3 text-center text-gray-800">feedbacks</h1>

<?php if(isset($_SESSION['success'])): ?>

<div class="alert alert-success">
    <?= $_SESSION['success']; ?>
</div>

<?php 

endif; 

unset($_SESSION['success']);

?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">feedbacks tables</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>email</th>
                        <th>feedback</th>
                        <th>control</th>
                    </tr>
                </thead>
                <tfoot>
                    <td>id</td>
                    <td>name</td>
                    <td>email</td>
                    <td>feedback</td>
                    <td>control</td>
                </tr>
                </tfoot>
                    <tbody>
                        <?php
                            $result = get_feedbacks($conn);
                            while($row = mysqli_fetch_assoc($result)):
                        ?>
                            <tr>
                                <td><?= $row['user_id'] ?></td>
                                <td><?= $row['first_name'] . ' ' . $row['last_name'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><textarea class="form-control bg-white border-0 text-muted" rows="3" disabled><?= $row['message'] ?></textarea></td>
                                <td>
                                <a class="" href="handlers/delete_feedback.php?id=<?= $row['id'] ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                                                <path class = 'text-danger' d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                                <path class = 'text-danger'  d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                </svg>
                                                </a>
                                </td>
                            </tr>
                        <?php
                                endwhile;
                        ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<?php include_once "inc/footer.php" ?> 