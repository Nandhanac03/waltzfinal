<!-- Inner page banner start -->
<?php if ($solution_banner) { ?>

    <div class="inner-banner">
        <div class="swiper-slider pbminfotech-gap-0px" data-arrows-class="portfolio-arrow" data-autoplay="true"
            data-loop="true" data-dots="false" data-arrows="true" data-columns="1" data-margin="0"
            data-effect="slide">
            <div class="swiper-wrapper">
                <!-- Slide1 -->
                <?php foreach ($solution_banner as $banner) { ?>

                    <article class="pbmit-portfolio-style-1 swiper-slide">
                        <div class="pbminfotech-post-content">
                            <div class="pbmit-featured-img-wrapper">
                                <div class="pbmit-featured-wrapper">
                                    <img src="<?= base_url('assets/uploads/album/' . $banner->file) ?>" class="img-fluid" alt="solutions">
                                </div>
                            </div>

                        </div>
                    </article>
                <?php } ?>
            </div>
        </div>
        <h3 class="inner-page-title">Solutions</h3>
    </div>
<?php } ?>

<!-- Inner page banner end -->


<!-- Page Content -->
<div class="page-content mb-4">
    <section class="brd">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb header-bradcrumb">
                        <li style="text-align: center;"><a href="<?= base_url() ?>">Home</a></li>
                        <li>---</li>
                        <li style="text-align: center;"><a href="<?= base_url() ?>#solutions">Solutions</a></li>
                        <li>---</li>
                        <li class="active"><?= $solution->title ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="team-skills solution section-sm" id="skills">
        <div class="container">
            <div class="row">

                <div class="col-md-7">
                    <div class="team-skills-content">
                        <h2><?= $solution->title ?></h2>

                        <div>
                            <?= $solution->formatted_short_desc ?>
                        </div>

                    </div>
                </div>
                <?php if ($solution->cover_img) { ?>
                    <div class="col-md-5">
                        <!-- <img style="height:710px;" src="<?= base_url('assets/uploads/solution/' . $solution->cover_img) ?>"> -->
                        <img class="img-fluid" src="<?= base_url('assets/uploads/solution/' . $solution->cover_img) ?>">
                    </div>
                <?php } ?>
                <?php
                $is_above  = false;
                // if (empty($solution->cover_img) && empty($solution->formatted_description) && empty($solution_additional_info) && empty($solution->additional_img)) {
                //     $is_above = true;
                if (empty($solution->cover_img)  && empty($solution->additional_img)) {
                    $is_above = true;
                ?>
                    <?php if ($solution_documents) { ?>
                        <div class="col-md-5 col-md-offset-1 tel-new download">
                            <?php foreach ($solution_documents as $document) { ?>
                                <a href="<?= base_url('assets/uploads/document/' . $document->file) ?>" target=_blank class="btn btn-main mt-20"> <i><img
                                            src="<?= base_url('assets/web/images/pdf.png') ?>"></i><?= $document->title ?> Brochure<span>
                                        <img src="<?= base_url('assets/web/images/download.png') ?>"></span> </a>

                            <?php } ?>
                        </div>
                <?php }
                } ?>
            </div> <!-- End row -->
        </div> <!-- End container -->
    </section> <!-- End section -->
    <section class="team-skills solution section-sm11 bg-gr" id="skills">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <?= $solution->formatted_description ?>
                </div>
            </div>
            <div class="row place">
                <?php if ($solution_additional_info) { ?>
                    <div class="col-md-8 telim">
                        <?php
                        $items = $solution_additional_info;
                        $item_count = count($items);
                        $index = 0;

                        while ($index < $item_count) {
                            echo '<div class="row">';

                            // First row: 1 empty col-md-1 + 3 items
                            if ($index == 0) {
                                echo '<div class="col-md-1"></div>';
                                for ($i = 0; $i < 3 && $index < $item_count; $i++, $index++) {
                                    $item = $items[$index];
                        ?>
                                    <div class="col-md-3">
                                        <div class="place2">
                                            <h5><?= htmlspecialchars($item->title) ?></h5>
                                            <p>UP TO <?= htmlspecialchars($item->count) ?>%</p>
                                        </div>
                                    </div>
                                <?php
                                }
                            } elseif ($index == 3) {
                                echo '<div class="col-md-4"></div>';
                                if ($index < $item_count) {
                                    $item = $items[$index];
                                ?>
                                    <div class="col-md-3">
                                        <div class="place2">
                                            <h5><?= htmlspecialchars($item->title) ?></h5>
                                            <p>UP TO <?= htmlspecialchars($item->count) ?>%</p>
                                        </div>
                                    </div>
                                <?php
                                    $index++;
                                }
                            } elseif ($index == 4) {
                                echo '<div class="col-md-1"></div>';
                                for ($i = 0; $i < 3 && $index < $item_count; $i++, $index++) {
                                    $item = $items[$index];
                                ?>
                                    <div class="col-md-3">
                                        <div class="place2">
                                            <h5><?= htmlspecialchars($item->title) ?></h5>
                                            <p>UP TO <?= htmlspecialchars($item->count) ?>%</p>
                                        </div>
                                    </div>
                        <?php
                                }
                            }
                            echo '</div>'; // Close the row
                        }
                        ?>
                    </div>
                <?php } ?>
                <?php if ($is_above == false) { ?>
                    <?php if ($solution->additional_img) { ?>
                        <div class="col-md-4 ">
                            <img style="height:650px;" src="<?= base_url('assets/uploads/solution/' . $solution->additional_img) ?>">
                        </div>
                <?php }
                } ?>
            </div> <!-- End row -->

        </div> <!-- End container -->
    </section> <!-- End section -->

    <?php if (!$is_above && $solution_documents) { ?>
        <!-- <section class="pdtimg">

            <div class="container">

                <div class="row">

                    <div class="col-md-6 col-md-offset-1 tel-new download">
                        <?php foreach ($solution_documents as $document) { ?>
                            <a href="<?= base_url('assets/uploads/document/' . $document->file) ?>" target=_blank class="btn btn-main mt-20"> <i><img
                                        src="<?= base_url('assets/web/images/pdf.png') ?>"></i><?= $document->title ?> Brochure<span>
                                    <img src="<?= base_url('assets/web/images/download.png') ?>"></span> </a>

                        <?php } ?>
                    </div>

                </div>

            </div>

        </section> -->
        <section class="pdtimg">
            <div class="container">
                <div class="row justify-content-center">
                    <?php foreach ($solution_documents as $document) { ?>
                        <div class="col-md-4 col-sm-6 download">

                            <a href="<?= base_url('assets/uploads/document/' . $document->file) ?>" target="_blank" class="btn btn-main mt-20 w-100"> <i><img src="<?= base_url('assets/web/images/pdf.png') ?>"></i><?= $document->title ?> Brochure<span>
                                    <img src="<?= base_url('assets/web/images/download.png') ?>"></span> </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    <?php } ?>

    <?php if ($solution->note) { ?>
        <section class="pdtimg">

            <div class="container">

                <div class="row">
                    <div class="mt-5  p-3 rounded">

                    <p> <strong><?= $solution->note ?></strong>
                            </p>
                            <div class="pbmit-button-box">
                                <a href="<?= base_url('contact_us') ?>" class="pbmit-btn">
                                    <span class="pbmit-button-text">Contact Us</span>
                                </a>

                            </div>
                    </div>
                </div>

            </div>

        </section>
    <?php } ?>

    <!-- Portfolio Start -->
    <?php if ($solution_images) { ?>
        <section class="portfolio-section-inner-p" data-aos="fade-up" data-aos-duration="800">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="pbmit-heading-subheading">

                        <h2 class="pbmit-title">Our Products</h2>
                    </div>
                    <div class="d-inline-flex portfolio-arrow"></div>
                </div>
            </div>
            <div class="container p-0">
                <div class="swiper-slider pbminfotech-gap-0px" data-arrows-class="portfolio-arrow"
                    data-autoplay="true" data-loop="true" data-dots="false" data-arrows="true" data-columns="4"
                    data-margin="0" data-effect="slide">
                    <div class="swiper-wrapper">
                        <!-- Slide1 -->
                        <?php foreach ($solution_images as $images) { ?>
                            <article class="pbmit-portfolio-style-1 swiper-slide">
                                <div class="pbminfotech-post-content">
                                    <div class="pbmit-featured-img-wrapper">
                                        <div class="pbmit-featured-wrapper">
                                            <img src="<?= base_url('assets/uploads/solution/' . $images->file) ?>" class="img-fluid" alt="solutions">
                                        </div>
                                    </div>

                                </div>
                            </article>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </section>
    <?php } ?>
    <!-- Portfolio End -->

    






</div>
<!-- Page Content End -->