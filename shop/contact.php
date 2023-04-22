<?php

    // include page title div
    $page_h1 = 'contact';
    $page_name = 'contact';
    require_once 'inc/page_header_title.php';
    $p = explode('/',$_SERVER['PHP_SELF']);
    if(!isset($_SESSION['auth']) && !in_array('index.php',$p) ){
        header('location: ../index.php?page=shop');
    }
?>




    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Contact For Any Queries</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form">
                    <div id="success"></div>
                    <form name="sentMessage" method='POST' action='shop/handlers/add_feedback.php' id="contactForm" novalidate="novalidate">
                        <div class="control-group">
                            <textarea class="form-control" rows="6" id="message" placeholder="Message" name ='message'
                                data-validation-required-message="Please enter your message"></textarea>
                            <!-- <p class="help-block text-danger"></p> -->
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <h5 class="font-weight-semi-bold mb-3">Get In Touch</h5>
                <p>we will be always happy to hear your opinion.</p>
                <div class="d-flex flex-column mb-3">
                    <h5 class="font-weight-semi-bold mb-3">Store 1</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>El-dokki - 5 mosadak st , third floor</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>fareselshinawy@gmail.com</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+201100162900</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->



