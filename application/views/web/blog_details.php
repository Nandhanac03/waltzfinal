<main id="main">
    <!-- Hero Section - Home Page✅ -->
    <section class="innerpage-banner">
        <img src="<?= base_url('assets/uploads/album/' . $inner_banner->file) ?>" alt="banner" data-aos="fade-in" class="img-fluid" />
    </section>
    <!-- End Hero Section -->

    <!-- Recent-posts Section -->
    <section id="recent-posts" class="recent-posts">
        <!--  Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Recent Post</h2>
            <div class="mt-4 col-12 right text-center">
                <a href="<?= base_url('blog') ?>" class="px-3 py-2 rounded"><i class="bi bi-arrow-left me-2"></i><span>Go back</span></a>
            </div>
        </div><!-- End Section Title -->
        <div class="container">
            <div class="row gy-4">
                <div class="card border-0 shadow" style="">
                    <div class="card-body p-5">
                        <div class="" style=" margin:35px 35px 0 35px;float: left;">
                            <img src="<?= base_url('assets/uploads/blog/' . $blog->desc_img) ?>" class="" alt="..." style="height: 18rem;">
                            <div class="d-flex align-items-center mt-3">
                                <?php if (isset($blog->brand_img)) { ?>
                                    <img src="<?= base_url('assets/uploads/blog/' . $blog->brand_img) ?>" alt="<?= $blog->subtitle ?>" class="img-fluid post-author-img flex-shrink-0">
                                <?php } else { ?>
                                    <img src="<?= base_url('assets/web/img/profile.png') ?>" alt="<?= $blog->subtitle ?>" class="img-fluid post-author-img flex-shrink-0">
                                <?php } ?>
                                <div class="post-meta">
                                    <p class="post-author"><?= $blog->subtitle ?></p>
                                    <p class="post-date">
                                        <time><?= date('M d, Y', $blog->created_at) ?></time>
                                    </p>
                                </div>
                            </div>
                            <div class="mt-2 text-end">
                                <p class="post-category " style="font-size: 0.9rem;"><i><span class="text-dark fw-bold">Section : </span><?= $blog->additional_info ?></i></p>
                            </div>
                            <hr>
                        </div>
                        <h5 class="card-title text-center fs-2"><i class="bi bi-quote quote-icon-left"></i><?= $blog->title ?><i class="bi bi-quote quote-icon-right"></i></h5>
                        <hr>
                        <p class="card-text" style="text-align: justify; line-height: 2rem;"><?= $blog->description ?></p>
                    </div>
                </div>
            </div><!-- End recent posts list -->
        </div>
    </section><!-- End Recent-posts Section -->
</main>