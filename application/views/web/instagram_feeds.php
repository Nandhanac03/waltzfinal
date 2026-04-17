<main id="main">
  <!-- ======= Breadcrumbs ======= -->
  <section id="breadcrumbs" class="breadcrumbs p-4">
    <div class="container">
      <ol>
        <li><a href="<?= base_url('#') ?>">Home</a></li>
        <li>Instagram Feeds</li>
      </ol>
      <h2>Instagram Feeds</h2>
    </div>
  </section><!-- End Breadcrumbs -->

  <!-- <?php foreach ($instagram_feeds['data'] as $feeds) {
          echo $feeds['media_url'];
        } ?> -->

  <!-- ======= Services Section ======= -->
  <section id="insta" class="insta">
    <div class="container" data-aos="fade-up">
      <div class="row">
        <?php if ($instagram_feeds) {
          foreach ($instagram_feeds['data'] as $key => $feeds) { ?>
            <div class="col-lg-4 col-md-6 mb-5">
              <div class="portfolio-content h-100">
                <img src="<?= $feeds['media_url'] ?>" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <a href="<?= $feeds['permalink'] ?>" target="_blank" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Projects Item -->
          <?php if ($key == $no_of_posts) {
              break;
            }
          }
        } else { ?>

          <div class="col-lg-4 col-md-6 mb-5">
            <div class="portfolio-content h-100">
              <img src="<?= base_url('assets/web/') ?>img/insta/1.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <a href="#" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div>
          </div><!-- End Projects Item -->

          <div class="col-lg-4 col-md-6 mb-5">
            <div class="portfolio-content h-100">
              <img src="<?= base_url('assets/web/') ?>img/insta/2.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <a href="#" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div>
          </div><!-- End Projects Item -->

          <div class="col-lg-4 col-md-6 mb-5">
            <div class="portfolio-content h-100">
              <img src="<?= base_url('assets/web/') ?>img/insta/3.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <a href="#" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div>
          </div><!-- End Projects Item -->

          <div class="col-lg-4 col-md-6 mb-5">
            <div class="portfolio-content h-100">
              <img src="<?= base_url('assets/web/') ?>img/insta/4.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <a href="#" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div>
          </div><!-- End Projects Item -->

          <div class="col-lg-4 col-md-6 mb-5">
            <div class="portfolio-content h-100">
              <img src="<?= base_url('assets/web/') ?>img/insta/5.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <a href="#" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div>
          </div><!-- End Projects Item -->

          <div class="col-lg-4 col-md-6 mb-5">
            <div class="portfolio-content h-100">
              <img src="<?= base_url('assets/web/') ?>img/insta/6.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <a href="#" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
              </div>
            </div>
          </div><!-- End Projects Item -->
        <?php } ?>
      </div>
  </section><!-- End Services Section -->

</main><!-- End #main -->