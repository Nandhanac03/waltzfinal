<!-- Start of Breadcrumb section	============================================= -->
<section id="arck-breadcrumb" class="arck-breadcrumb-section-2 position-relative" data-background="<?= base_url('assets/web/img/bg/ar-shape.png') ?>">
    <div class="container">
        <div class="arck-breadcrumb-content position-relative text-center headline-2 ul-li">
            <h1><?= $title->subtitle ?></h1>
            <ul>
                <li><a href="<?= base_url('/') ?>">Home</a></li>
                <li><?= $title->subtitle ?></li>
            </ul>
        </div>
    </div>
</section>
<!-- End of Breadcrumb section	============================================= -->


<!-- Start of Testimonial  section✅	============================================= -->
<section id="archx-testimonial-2" class="archx-testimonial-section-2 position-relative">
    <span class="archx-testimonial-bg-2 position-absolute"><img src="<?= base_url('assets/web/img/bg/ar-tst-bg.png') ?>" alt=""></span>
    <div class="container">
        <div class="archx-testimonial-content-2">
            <div class="archx-testimonial-2-slider-wrapper">
                <div class="archx-testimonial-slider-2">
                    <?php foreach ($testimonials as $testimonial) { ?>
                        <div class="archx-testimonial-slider-item-2">
                            <div class="archx-testimonial-img-text-2 d-flex align-items-center">
                                <div class="archx-testimonial-img-2 position-relative">
                                    <span class="archx-shape1 position-absolute"><img src="<?= base_url('assets/web/img/testimonial/ar-tst-shape2.png') ?>" alt=""></span>
                                    <span class="archx-testimonial-quote position-absolute"><i class="fas fa-quote-right"></i></span>
                                    <div class="archx-shape2 position-absolute">
                                        <img src="<?= base_url('assets/web/img/bg/dot-shape1.png') ?>" alt="">
                                    </div>
                                </div>
                                <div class="archx-textimonial-text-2 headline-2 pera-content">
                                    <h3> </h3>
                                    <p><?= $testimonial->statement ?></p>
                                    <div class="archx-testimonial-author-2 d-flex align-items-center">
                                        <h4><?= $testimonial->statement_by ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="carousel_nav">
                    <button type="button" class="ar-tst_2_left_arrow text-uppercase"><i class="fal fa-long-arrow-left"></i></button>
                    <button type="button" class="ar-tst_2_right_arrow text-uppercase"><i class="fal fa-long-arrow-right"></i></button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End of Testimonial  section	============================================= -->