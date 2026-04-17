<div class="breadcrumb-area text-center shadow dark text-light bg-cover" style="background-image: url(<?= base_url('assets/web/') ?>img/banner/11.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h1><?= $web_labels['SERVICES'] ?></h1>
                <ul class="breadcrumb">
                    <li><a href="#"><i class="fas fa-home"></i> <?= $web_labels['HOME'] ?></a></li>
                    <li class="active"><?= $web_labels['SERVICES'] ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="thumb-services-area inc-thumbnail default-padding bottom-less bg-gray">
    <!-- Shape -->
    <div class="right-shape">
        <img src="<?= base_url('assets/web/') ?>img/shape/9.png" alt="Shape">
    </div>
    <!-- Shape -->
    <div class="container">
        <div class="services-items text-left">
            <div class="row bg-gray">
                <!-- Single Item -->
                <div class="col-lg-12 col-md-12">
                    <div>
                        <?php echo $services ?>
                    </div>
                    <br>
                    <a class="btn btn-gradient effect btn-md" href="<?= base_url() ?>contact_us/enquiry/<?= $enquiry ?>"><?= $web_labels['POST_ENQUIRY'] ?></a>
                </div>
                <!-- End Single Item -->

            </div>
        </div>
    </div>
</div>




<!-- ("overflow-hidden-box overflow-hidden" helps you to ignore extra width for the circle shape)-->
<div class="overflow-hidden-box overflow-hidden">


    <!-- Star testimonials Area
        ============================================= -->
    <div class="testimonials-area bg-gray default-padding-bottom">
        <!-- Fixed Shape -->
        <div class="fixed-shape" style="background-image: url(<?= base_url('assets/web/') ?>img/shape/10-red.png);"></div>
        <!-- End Fixed Shape -->
        <div class="container">
            <div class="testimonial-items">
                <div class="row align-center">
                    <div class="col-lg-7 testimonials-content">
                        <div class="testimonials-carousel owl-carousel owl-theme">
                            <!-- Single Item -->
                            <div class="item">
                                <div class="info">
                                    <p>

                                        <?= $web_labels['SOARING_HIGH_FOR_EXCELLENCE__'] ?> <br>
                                        <?= $web_labels['THE_TEAM_IS_VERY_ACCOMMODATING__THEY_TREAT_THEIR_CLIENT_S__ME_WITH_RESPECT_AND_VERY_PROFESSIONALLY_D'] ?>

                                    </p>
                                    <div class="provider">

                                        <div class="content">
                                            <h4><?= $web_labels['MHYR_ORBITA'] ?></h4>
                                            <span> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Item -->
                            <!-- Single Item -->
                            <div class="item">
                                <div class="info">
                                    <p>
                                        <?= $web_labels['AN_EXCELLENT_EXPERIENCE_WITH_AN_EXCELLENT_ARRANGEMENT_INTERVIEW_ONLINE__KEEP_UP_THE_GOOD_WORK_'] ?> </p>
                                    <div class="provider">

                                        <div class="content">
                                            <h4><?= $web_labels['ITOL_GOLD_BORJA'] ?></h4>
                                            <span> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Item -->
                        </div>
                    </div>
                    <div class="col-lg-5 info">
                        <h4><?= $web_labels['TESTIMONIALS'] ?></h4>
                        <h2><?= $web_labels['CHECK_WHAT_OUR_SATISFIED_CLIENTS_SAID'] ?></h2>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End testimonials Area -->
</div>
<!-- End Overflow Hidden Box -->




<div class="partner-area shadow-less overflow-hidden text-light">
    <div class="container">
        <div class="item-box">
            <div class="row align-center">
                <div class="offset-lg-2 col-lg-6 info">
                    <h2><?= $web_labels['FOR_BUSINESS_ENQUIRY'] ?></h2>

                </div>
                <div class="col-lg-4 clients">
                    <a class="btn btn-light effect btn-md" href="<?= base_url() ?>contact_us"><?= $web_labels['CONTACT_US'] ?></a>

                </div>
            </div>
        </div>
    </div>
</div>