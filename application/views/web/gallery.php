<section class="inner-page-header position-relative">
    <img src="<?= base_url('assets/web') ?>/img/about-header.jpg" class="img-fluid">

    <div class="sub-page-title d-flex flex-column align-items-center breadcrumbs">

        <h2>Gallery</h2>
        <ol>
            <li><a href="<?= base_url() ?>">Home</a></li>
            <li>Gallery</li>
        </ol>

    </div>

</section> <!-- End inner-page-header -->

<main>



    <section id="portfolio" class="portfolio">
        <div class="container" data-aos="fade-up">


            <div class="section-header">
                <h2>Recent Projects</h2>
            </div>

            <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order">



                <div class="row gy-4 portfolio-container aos-init aos-animate" data-aos="fade-up" data-aos-delay="300" style="position: relative; height: 1069.62px;">


                    <?php
                    if ($gallery) {
                        foreach ($gallery as $items) {
                            $main = 'others';
                            if ($gallery_main && isset($gallery_main[$items->newsroom])) {
                                $main = $gallery_main[$items->newsroom];
                            }
                    ?>
                            <div class="col-lg-4 col-md-6 portfolio-item filter-<?= $main ?>" style="position: absolute; left: 0px; top: 0px;">
                                <img src="<?= base_url('assets/uploads/news/').$items->file ?>" class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <h4><?= $items->title ?></h4>
                                    <p><?= $items->description ?></p>
                                    <a href="<?= base_url('assets/uploads/news/').$items->file ?>" title="<?= $items->title ?>" data-gallery="portfolio-gallery-<?= $main ?>" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                    <a href="javascript:void(0)" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                                </div>
                            </div><!-- End Portfolio Item -->
                    <?php
                        }
                    }
                    ?>

                </div>

            </div>
        </div>
    </section>
</main>




<!-- ======= Hero Section ======= -->

<!-- ======= Hero Section End ======= -->


<!-- End #main -->