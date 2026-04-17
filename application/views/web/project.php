  <!-- Page Header Start -->
  <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
      <div class="container text-center py-5 mt-4">
          <h1 class="display-2 text-white mb-3 animated slideInDown">Projects</h1>

      </div>
  </div>
  <!-- Page Header End -->



  <?php if ($projects) { ?>
      <!-- ======= projects Section ======= -->
      <section id="projects" class="projects mt-5">
          <div class="container">

              <div class="row projects-container d-flex align-items-center justify-content-center">
                  <?php foreach ($projects as $key => $project) {
                        if ($key > 5) {
                            break;
                        } ?>
                      <div class="col-lg-4 col-sm-6 projects-item">
                          <img src="<?= base_url('assets/uploads/blog/' . $project->desc_img) ?>" class="img-fluid" alt="">
                          <div class="projects-info text-center">
                              <h4><?= $project->title ?></h4>
                              <a href="<?= base_url('projects/info/' . $project->title_slug) ?>" title="More Details"><i class="bi bi-link-45deg"></i> View More</a>
                          </div>
                      </div>
                  <?php  } ?>

                  <!-- <div class="col-md-12 text-center mb-5"> <a href="projects.html"
                          class="btn btn-primary text-white py-2 px-4">View More</a>
                  </div> -->


              </div>

          </div>
      </section><!-- End projects Section -->

  <?php } ?>
  <!-- client Start -->

  <div class="container-fluid client py-4">
      <div class="container">
          <div class="row gy-5 gx-0">

              <div class="col-12">

                  <h4 class="display-6 mb-4 text-center"><?= $ouralbum->title ?></h4>


                  <div class="p-2">
                      <div class="owl-carousel client-carousel wow fadeIn" data-wow-delay="0.1s">
                          <?php if ($clientslogs) {
                                foreach ($clientslogs as $logo) { ?>
                                  <div class="client-item">
                                      <img src="<?= base_url('assets/uploads/album/' . $logo->file) ?>">
                                  </div>
                          <?php }
                            } ?>




                      </div>

                  </div>
              </div>

          </div>
      </div>
  </div>
  <!-- client End -->