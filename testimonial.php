<?php
require_once("functions/function.php");
get_header();

?>


<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-1.jpg);">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Testimonial</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Testimonial</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Testimonial Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="text-center">
            <h6 class="text-primary text-uppercase"> Testimonial </h6>
            <h1 class="mb-5">Our Clients Say!</h1>
        </div>
        <div class="owl-carousel testimonial-carousel position-relative">

            <?php

            $select_qurry = "SELECT * FROM `testimonial`";

            $allTestimonial = mysqli_query($con, $select_qurry);

            while ($testimonial = mysqli_fetch_assoc($allTestimonial)) {

            ?>
                <div class="testimonial-item text-center">
                    <img class="bg-light rounded-circle p-2 mx-auto mb-3" src="admin/uploads/<?= $testimonial['client_photo'] ?>" style="width: 80px; height: 80px;">
                    <h5 class="mb-0"><?= $testimonial['client_name'] ?></h5>
                    <p>Profession</p>
                    <div class="testimonial-text bg-light text-center p-4">
                        <p class="mb-0"><?= $testimonial['client_details'] ?></p>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- Testimonial End -->


<?php
get_footer();

?>