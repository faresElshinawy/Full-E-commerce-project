    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="index.php">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <?php 
                        if(isset($_SESSION['auth'])):
                    ?>
                    <a class="text-dark" href="index.php?page=contact">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="index.php?page=contact">Support</a>
                    <?php else: ?>
                    <a class="text-dark" href="index.php?page=login">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="index.php?page=login">Support</a>
                        <?php 
                        endif; 
                        ?>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="https://www.facebook.com/fares.elshinawi" target='_blank'>
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="https://twitter.com/Shinawii1" target='_blank'>
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="https://www.linkedin.com/in/shinawii-undefined-26830b258/" target='_blank'>
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="https://www.instagram.com/fares.elshinawy/" target='_blank'>
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="https://www.youtube.com/channel/UCvLl4dfYxy6DO9hnt78nkDw" target='_blank'>
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="index.php" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">Pix</span> Market</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form action="index.php?search=search" method='post'>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for products" name='name'>
                        <!-- <div class="input-group-append"> -->
                            <span class="bg-transparent text-primary ml-1">
                                <button type='submit' class='btn btn-primary rounded'><i class="fa fa-search"></i></button>
                            </span>
                        <!-- </div> -->
                    </div>
                </form>
            </div>
            <!-- shop cart and wishlist condition -->
            <?php 
                if(isset($_SESSION['auth'])):
            ?>
            <div class="col-lg-3 col-6 text-right">
                <a href="index.php?page=wishlist" class="btn border">
                    <i class="fas fa-heart text-primary"></i>
                    <span class="badge">0</span>
                </a>
                <a href="index.php?page=cart" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge">0</span>
                </a>
                <a href="index.php?page=order_history" class="btn border">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                <path class='text-primary' d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                <path class='text-primary' d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
                <path class='text-primary' d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                </svg>
                    <span class="badge">0</span>
                </a>
            </div>
            <?php
                endif;
            ?>
        </div>
    </div>
    <!-- Topbar End -->



    