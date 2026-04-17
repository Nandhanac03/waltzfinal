<div class="breadcrumb-area text-center shadow dark text-light bg-cover" style="background-image: url(<?= base_url('assets/web/') ?>img/banner/13.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h1><?= $web_labels['CAREERS'] ?></h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> <?= $web_labels['HOME'] ?></a></li>
                        <li class="active"><?= $web_labels['CAREERS'] ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
  


    <div class="earna-career default-padding bg-gray">
        <div class="right-shape">
            <img src="<?= base_url('assets/web/') ?>img/shape/9.png" alt="Shape">
        </div>
        <div class="container">
         
            <div class="job-lists">
                <div class="row">
                    <?php
                    if($careers) {
                        foreach($careers as $career) {
                            ?>
                            <div class="col-lg-12" style="margin-bottom: 30px;">
                            <!-- Single Item -->
                            <div class="item">
                                <div class="info">
                                    <?= $career->subtitle ?>
                                </div>
                            </div>
                            <!-- End Single Item -->
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>


    


    
    <!-- ("overflow-hidden-box overflow-hidden" helps you to ignore extra width for the circle shape)-->
    <div class="overflow-hidden-box overflow-hidden" style="display: none;">
 

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
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. 
                                        </p>
                                        <div class="provider">
                                           
                                            <div class="content">
                                                <h4>Ahel Natasha</h4>
                                                <span> Employee</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                                <!-- Single Item -->
                                <div class="item">
                                    <div class="info">
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled. 
                                        </p>
                                        <div class="provider">
                                            
                                            <div class="content">
                                                <h4>Sam</h4>
                                                <span> Employee </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                            </div>
                        </div>
                        <div class="col-lg-5 info">
                            <h4>Testimonials</h4>
                            <h2>Check what our satisfied Employees said</h2>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End testimonials Area -->
    </div>
    <!-- End Overflow Hidden Box -->