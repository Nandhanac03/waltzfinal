<div class="pbmit-slider-area pbmit-slider-two">




</div>

<div class="pbmit-slider-area pbmit-slider-two banner-slider">
  <?php if ($banners) { ?>

    <div
      class="swiper-slider"
      data-autoplay="true"
      data-loop="true"
      data-dots="false"
      data-arrows="true"
      data-columns="1"
      data-margin="0"
      data-effect="fade">
      <div class="swiper-wrapper">
        <?php foreach ($banners as $b_key => $banner) { ?>
          <div class="swiper-slide">
            <div class="pbmit-slider-item">
              <div
                class="pbmit-slider-bg"
                style="
                      background-image: url('<?= base_url('assets/uploads/album/' . $banner->file) ?>');
                    "></div>
              <div class="container">
                <div class="row g-0">
                  <div class="col-md-12 col-lg-12 text-center">
                    <div class="pbmit-slider-block">
                      <div class="pbmit-slider-content">
                        <h2
                          class="pbmit-slider-title transform-left transform-delay-2 
                                    <?php if ($banner->id == 93) echo ' f-46'; ?>">
                          <?php if ($banner->id == 93) { ?>
    <a href="<?= base_url('#' . $banner->subtitle) ?>" style="color: inherit; text-decoration: none;">
       <span> <?= $banner->title ?></span>
    </a>
<?php } else { ?>
  <span> <?= $banner->title ?></span>
<?php } ?>
                        </h2>
                        <div class="pbmit-button text-center">
                          <div class="transform-bottom transform-delay-3">
                            <?php
                            $link = (strpos($banner->subtitle, '/') === false)
                              ? '#' . $banner->subtitle
                              : $banner->subtitle;
                            ?>
<?php if ($banner->id != 93) { ?>
                            <a href="<?= base_url($link) ?>" class="pbmit-btn">
                              <span class="pbmit-button-text">LEARN MORE</span>
                            </a>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>

      </div>
    </div>
  <?php } ?>

</div>
</header>


<!-- Header Main Area End Here -->

<!-- Page Content -->
<div class="page-content">




  <!-- services End -->

  <!-- services Start -->
  <?php if ($final_categories) { ?>

    <section
      class="services"
      id="solutions"
      data-aos="fade-up"
      data-aos-duration="400">
      <div class="container">
        <div class="d-flex align-items-center justify-content-between">
          <div class="pbmit-heading-subheading text-center">
            <h2 class="pbmit-title"><?= $solution->title ?></h2>
          </div>
        </div>
      </div>
      <div class="container p-0">
        <div
          class="swiper-slider pbminfotech-gap-0px"
          data-arrows-class="portfolio-arrow"
          data-autoplay="true"
          data-loop="true"
          data-dots="false"
          data-arrows="true"
          data-columns="3"
          data-margin="0"
          data-effect="slide">
          <div class="swiper-wrapper">
            <!-- Slide1 -->
            <?php foreach ($final_categories as $category) {
              if ($category->description) {
            ?>
                <article class="pbmit-portfolio-style-1 swiper-slide">
                  <div class="pbminfotech-post-content">
                    <div class="pbmit-featured-img-wrapper">
                      <div class="pbmit-featured-wrapper">
                        <a
                          href="<?= base_url('solution/info/' . $category->title_slug) ?>"
                          class="service-work card border-0 text-white overflow-hidden m-sm-0">
                          <img
                            class="service card-img"
                            src="<?= base_url('assets/uploads/solution/' . $category->description) ?>"
                            alt="Card image" />

                          <div
                            class="service-work-vertical card-img-overlay d-flex align-items-end text-center">
                            <div
                              class="service-work-content text-light text-center">
                              <span
                                class="btn btn-outline-light rounded-pill mb-lg-3 px-lg-4 light-300"><?= $category->title ?></span>
                            </div>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                </article>
            <?php }
            } ?>
          </div>
        </div>
      </div>
    </section>
  <?php } ?>
  <!-- services End -->



  <!-- Fid Start -->
  <?php if ($status) { ?>
    <section class="fid-section-two mt-0" data-aos="fade-up" data-aos-duration="800">
      <div class="container-fluid p-0">
        <div class="row g-2">
          <?php foreach ($status as $key => $item) { ?>

            <div class="col-md-6 col-xl-3">
              <div class="fid-style-wrap">
                <div class="pbminfotech-ele-fid-style-2 text-center">
                  <div class="pbmit-fld-contents">
                    <div class="pbmit-fld-wrap">

                      <img src="<?= base_url('assets/web/images/count' . ++$key . '.png') ?>">


                      <h4 class="pbmit-fid-inner">
                        <span class="pbmit-fid-before"></span>
                        <span class="pbmit-number-rotate numinate"
                          data-appear-animation="animateDigits" data-from="0" data-to="<?= $item->count ?>"
                          data-interval="5" data-before="" data-before-style="" data-after=""
                          data-after-style=""><?= $item->count ?></span>
                        <span class="pbmit-fid"><span>+</span></span>
                      </h4>

                      <div class="pbmit-fid-icon-title">
                        <span class="pbmit-fid-title"><?= $item->title ?></span>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

        </div>
      </div>
    </section>
  <?php } ?>
  <!-- Fid End -->




  <!-- Portfolio End -->

  <!-- Portfolio Start -->

  <?php if ($home_products) { ?>

    <section
      class="portfolio-section-inner-p"
      data-aos="fade-up"
      data-aos-duration="800" id="products">
      <div class="container">
        <div class="d-flex align-items-center justify-content-between">
          <div class="pbmit-heading-subheading">
            <h2 class="pbmit-title"><?= $ourproduct->title ?></h2>
          </div>
        </div>
      </div>
      <div class="container p-0">
        <div
          class="swiper-slider pbminfotech-gap-0px"
          data-arrows-class="portfolio-arrow"
          data-autoplay="true"
          data-loop="true"
          data-dots="false"
          data-arrows="true"
          data-columns="3"
          data-margin="0"
          data-effect="slide">
          <div class="swiper-wrapper">
            <!-- Slide1 -->
            <?php foreach ($home_products as $product) { ?>

              <article class="pbmit-portfolio-style-1 swiper-slide">
                <div class="pbminfotech-post-content">
                  <div class="pbmit-featured-img-wrapper">
                    <div class="pbmit-featured-wrapper">
                      <img
                        src="<?= base_url('assets/uploads/album/' . $product->file) ?>"
                        class="img-fluid"
                        alt="solutions" />
                    </div>

                    <a href="<?= base_url($product->subtitle) ?>" class="rounded-pill text-center product-ab"><?= $product->title ?></a>
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
  <!-- services Start -->

  <?php if ($services) { ?>

    <section class="services" id="services">

      <div class="container">
        <div class="d-flex align-items-center justify-content-between">
          <div class="pbmit-heading-subheading">
            <h2 class="pbmit-title"><?= $ourservice->title ?></h2>
          </div>
        </div>
      </div>
      <div class="container p-0">

        <div
          class="swiper-slider pbminfotech-gap-0px"
          data-arrows-class="portfolio-arrow"
          data-autoplay="true"
          data-loop="true"
          data-dots="false"
          data-arrows="true"
          data-columns="3"
          data-margin="0"
          data-effect="slide">
          <div class="swiper-wrapper">
            <!-- Slide1 -->
            <?php foreach (array_reverse($services) as $index => $service) { ?>

              <article class="pbmit-portfolio-style-1 swiper-slide">
                <a
                  href="<?= base_url('services/info/' . $service->title_slug) ?>"
                  class="recent-work card border-0 shadow-lg overflow-hidden">
                  <img
                    class="recent-work-img card-img"
                    src="<?= base_url('assets/uploads/bio/' . $service->desc_img) ?>"
                    alt="Card image" />

                  <div
                    class="recent-work-vertical card-img-overlay d-flex align-items-end">
                    <div
                      class="recent-work-content text-start mb-3 ml-3 text-light">
                      <span
                        class="btn btn-outline-light rounded-pill mb-lg-3 px-lg-4 light-300"><?= $service->name ?></span>
                    </div>
                  </div>
                </a>
              </article>
            <?php } ?>

          </div>
        </div>
      </div>
    </section>
  <?php } ?>


  <?php if ($clients) { ?>
    <!-- Client Start -->
    <section class="client-section-one">
      <div class="container p-0">

        <div class="row no-gutters">
          <div class="col-12">
            <div class="title text-center">
              <h2><?= $customers->title ?></h2>

            </div>
          </div>
        </div> <!-- End row -->

        <div class="client-slider">
          <div class="client-main">
            <div class="swiper-wrapper row justify-content-center">
              <!-- Slide1 -->
              <?php foreach ($clients as $client) { ?>

                <div class="col-md-3 col-sm-6 col-6">
                  <div class="pbmit-client-style-1 swiper-slide">
                    <div class="pbmit-border-wrapper">
                      <div class="pbmit-client-wrapper pbmit-client-with-hover-img">
                        <h4 class="pbmit-hide">Client-01</h4>
                        <div class="pbmit-client-hover-img">
                          <img src="<?= base_url('assets/uploads/album/' . $client->file) ?>" alt="">
                        </div>
                        <div class="pbmit-featured-img-wrapper">
                          <div class="pbmit-featured-wrapper">
                            <img src="<?= base_url('assets/uploads/album/' . $client->file) ?>" alt="">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>

            </div>

          </div>
        </div>
      </div>
</div>
</section>
<?php } ?>

<!-- Client End -->

<!-- Client End -->

</div>
<!-- Page Content End -->