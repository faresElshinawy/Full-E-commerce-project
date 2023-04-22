<?php include_once "inc/header.php" ?> 
<?php include_once "inc/sidebar.php" ?>
<?php include_once "inc/topbar.php" ?> 
<?php include_once "core/user_func.php" ?> 



<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0 ">
            <!-- Nested Row within Card Body -->
            <div class="row d-flex justify-content-center">
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" method='post' action="handlers/handle_register.php" enctype='multipart/form-data'>
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
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName" name='firstname'
                                        placeholder="First Name">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" id="exampleLastName" name='lastname'
                                        placeholder="Last Name">
                                </div>
                            </div>
                            <?php if(isset($_SESSION['errors']['email'])): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $_SESSION['errors']['email']; ?>
                                    </div>
                                <?php  endif; ?>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="exampleInputEmail" name='email'
                                    placeholder="Email Address">
                            </div>
                            <?php if(isset($_SESSION['errors']['password'])): ?>
                                <div class="alert alert-danger">
                                    <?php echo $_SESSION['errors']['password']; ?>
                                </div>
                                <?php  endif; ?>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" name='password'>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                        id="exampleRepeatPassword" placeholder="Repeat Password" name='password_repeat'>
                                    </div>
                                </div>
                            <?php if(isset($_SESSION['errors']['address'])): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $_SESSION['errors']['address']; ?>
                                    </div>
                                <?php  endif; ?>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="exampleInputEmail" name='address'
                                    placeholder="address">
                            </div>
                            <?php if(isset($_SESSION['errors']['phone'])): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $_SESSION['errors']['phone']; ?>
                                    </div>
                                <?php  endif; ?>
                            <div class="form-group">
                                <input type="number" class="form-control form-control-user" id="exampleInputEmail" name='phone'
                                    placeholder="phone">
                            </div>
                            <?php if(isset($_SESSION['errors']['image'])): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $_SESSION['errors']['image']; ?>
                                    </div>
                                <?php  endif; ?>
                            <div class="form-group mb-3 ">
                            <label for="formFileMultiple" class="form-label text-muted ">upload image</label>
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
                                $i = 0;
                                $conn = db_conn();
                                $gender_data = get_gender_data($conn);
                                while($row = mysqli_fetch_assoc($gender_data)):
                            ?>
                                <option value="<?= $row['gender_id'] ?>" 
                                
                                <?php if($i < 1){
                                        echo "selected";
                                        $i++;
                                    }
                                    ?>
                                
                                ><?= $row['gender_name'] ?></option>
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
                                $i = 0;
                                $conn = db_conn();
                                $city_data = get_city_data($conn);
                                while($row = mysqli_fetch_assoc($city_data)):
                            ?>
                                <option value="<?= $row['city_id'] ?>" 

                                <?php if($i < 1){
                                        echo "selected";
                                        $i++;
                                    }
                                    ?>
                                
                                ><?= $row['city_name'] ?></option>
                                <?php endwhile; ?>
                            </select>
                            </div>
                            <div class="form-group mb-3 ">
                            <select name="permission" id="" class = "form-control">
                            <?php 
                                $i = 0;
                                $conn = db_conn();
                                $per_data = per_data($conn);
                                while($row = mysqli_fetch_assoc($per_data)):
                            ?>
                                <option value="<?= $row['per_id'] ?>" 

                                <?php if($i < 1){
                                        echo "selected";
                                        $i++;
                                    }
                                    ?>
                                
                                ><?= $row['per_name'] ?></option>
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

<?php unset($_SESSION['errors']); ?>

<?php include_once "inc/footer.php" ?> 
