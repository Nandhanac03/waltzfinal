    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5 mt-4">
            <h1 class="display-2 text-white mb-3 animated slideInDown">Projects</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- ======= projects Details Section ======= -->
    <div id="projects-details" class="projects-details container-fluid">
        <div class="container">
            <div class="row gy-4 mb-5">
                <div class="col-lg-8">
                    <img src="<?= base_url('assets/web/img/banner-3.jpg') ?>" class="img-fluid" />
                </div>
                <div class="col-lg-4">
                    <div class="projects-info">
                        <h3>Project information</h3>
                        <ul>
                            <?php if (!empty($project->subtitle)) { ?>
                                <li><strong>Category</strong>: <?= $project->subtitle ?>Solar</li>
                            <?php } ?>
                            <?php if (!empty($project->additional_info)) { ?>
                                <li><strong>Client</strong>: <?= $project->additional_info ?>ASU Company</li>
                            <?php } ?>
                            <?php if (!empty($project->project_date)) { ?>
                                <li><strong>Project date</strong>: <?= date('d F, Y', strtotime($project->project_date)) ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="projects-description">
                        <h2><?= $project->title ?></h2>
                        <p>
                            <?= $project->description ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End projects Details Section -->