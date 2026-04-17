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
            <h2><?= $recent_posts_title->title ?></h2>
            <p><?= $recent_posts_title->subtitle ?></p>
        </div><!-- End Section Title -->
        <div class="container">
            <div class="row gy-4">
                <?php if ($blogs) { ?>
                    <?php $delay = 100; ?>
                    <?php foreach ($blogs as $blog) { ?>
                        <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                            <article>
                                <div class="post-img">
                                    <img src="<?= base_url('assets/uploads/blog/' . $blog->desc_img) ?>" alt="<?= $blog->title ?>" class="img-fluid">
                                </div>
                                <p class="post-category"><?= $blog->additional_info ?></p>
                                <h2 class="title">
                                    <a href="<?= base_url('blog/' . $blog->title_slug) ?>"><?= $blog->title ?></a>
                                </h2>
                                <div class="d-flex align-items-center">
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
                            </article>
                        </div><!-- End post list item -->
                        <?php $delay += 100; ?>
                    <?php } ?>
                <?php } ?>
            </div><!-- End recent posts list -->
        </div>
    </section><!-- End Recent-posts Section -->
</main>