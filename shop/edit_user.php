<?php
    require_once 'shop/core/user_func.php';
    $p = explode('/',$_SERVER['PHP_SELF']);
    if(!isset($_SESSION['auth']) && !in_array('index.php',$p) ){
        header('location: ../index.php?page=shop');
    }

?>
<?php
    $page_h1 = 'edit info';
    $page_name = 'edit info';
    require_once 'inc/page_header_title.php';
    require_once 'core/user_func.php';
    $id = $_SESSION['auth']['id'];
    $row = user_id_info($conn,$id);
?>


<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0 ">
            <!-- Nested Row within Card Body -->
            <div class="row d-flex justify-content-center">
                <div class="col-lg-7">
                    <div class="p-5">   
                        <form class="user" method='post' action="shop/handlers/handle_edit_user.php" enctype='multipart/form-data'>
                        <?php if(isset($_SESSION['errors']['method'])): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $_SESSION['errors']['method']; ?>
                                    </div>
                                <?php  endif; ?>
                            <?php if(isset($_SESSION['errors']['firstname'])): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $_SESSION['errors']['firstname']; ?>
                                    </div>
                                <?php  endif; ?>
                                <?php if(isset($_SESSION['errors']['lastname'])): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $_SESSION['errors']['lastname']; ?>
                                    </div>
                                <?php  endif; ?>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName" name='firstname' value='<?= $row['first_name'] ?>'
                                        placeholder="First Name">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" id="exampleLastName" name='lastname' value='<?= $row['last_name'] ?>'
                                        placeholder="Last Name">
                                </div>
                            </div>
                            <?php if(isset($_SESSION['errors']['email'])): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $_SESSION['errors']['email']; ?>
                                    </div>
                                <?php  endif; ?>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="exampleInputEmail" name='email' value='<?= $row['email'] ?>'
                                    placeholder="Email Address">
                            </div>
                            <?php if(isset($_SESSION['errors']['password'])): ?>
                                <div class="alert alert-danger">
                                    <?php echo $_SESSION['errors']['password']; ?>
                                </div>
                                <?php  endif; ?>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" value='<?= $row['password'] ?>'
                                            id="exampleInputPassword" placeholder="Password" name='password'>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" value='<?= $row['password'] ?>'
                                        id="exampleRepeatPassword" placeholder="Repeat Password" name='password_repeat'>
                                    </div>
                                </div>
                            <?php if(isset($_SESSION['errors']['address'])): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $_SESSION['errors']['address']; ?>
                                    </div>
                                <?php  endif; ?>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="exampleInputEmail" name='address' value='<?= $row['address'] ?>'
                                    placeholder="address">
                            </div>
                            <?php if(isset($_SESSION['errors']['phone'])): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $_SESSION['errors']['phone']; ?>
                                    </div>
                                <?php  endif; ?>
                            <div class="form-group">
                                <input type="number" class="form-control form-control-user" id="exampleInputEmail" name='phone' value='0<?= $row['phone'] ?>'
                                    placeholder="phone">
                            </div>
                            <?php if(isset($_SESSION['errors']['image'])): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $_SESSION['errors']['image']; ?>
                                    </div>
                                <?php  endif; ?>
                            <div class="form-group mb-3 ">
                                <img src="uploaded/<?= $row['image'] ?>" class='img-fluid' alt="">
                            <input type="hidden" name='old_image' value='<?= $row['image'] ?>' />
                            </div>
                            <div class="form-group mb-3 ">
                            <label for="formFileMultiple" class="form-label text-muted ">upload new image</label>
                            <input class="form-control text-muted "  type="file" id="formFileMultiple" name='image' multiple />
                            </div>
                            <?php if(isset($_SESSION['errors']['gender'])): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $_SESSION['errors']['gender']; ?>
                                    </div>
                                <?php  endif; ?>
                            <div class="form-group mb-3 ">
                            <select name="gender" id="" class = "form-control">
                            <?php 
                                $conn = db_conn();
                                $gender_data = get_gender_data($conn);
                                while($row2 = mysqli_fetch_assoc($gender_data)):
                            ?>
                                <option value="<?= $row2['gender_id'] ?>" 
                                
                                <?php if($row['gender_name'] == $row2['gender_id']){
                                        echo "selected";
                                    }
                                    ?>
                                
                                ><?= $row2['gender_name'] ?></option>
                                <?php endwhile; ?>
                            </select>
                            </div>
                            <?php if(isset($_SESSION['errors']['city'])): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $_SESSION['errors']['city']; ?>
                                    </div>
                                <?php  endif; ?>
                            <div class="form-group mb-3 ">
                            <select name="city" id="" class = "form-control">
                            <?php 
                                $conn = db_conn();
                                $city_data = get_city_data($conn);
                                while($row2 = mysqli_fetch_assoc($city_data)):
                            ?>
                                <option value="<?= $row2['city_id'] ?>" 

                                <?php if($row['city_name'] == $row2['city_id']){
                                        echo "selected";
                                    }
                                    ?>
                                
                                ><?= $row2['city_name'] ?></option>
                                <?php endwhile; ?>
                            </select>
                            </div>
                            <button class='btn btn-primary btn-user btn-block'>submit</button>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    unset($_SESSION['errors']);
?>
