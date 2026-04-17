<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
  <div class="container text-center py-5 mt-4">
    <h1 class="display-2 text-white mb-3 animated slideInDown">News</h1>
    <nav aria-label="breadcrumb animated slideInDown">

    </nav>
  </div>
</div>
<!-- Page Header End -->

<div class="container-fluid latest-news py-5">
  <div class="container">
    <div class="row g-4">
      <?php foreach ($news as $each_news) { ?>
        <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
          <div class="latest-item">
            <div class="d-flex justify-content-between mb-4">
              <p class="mb-0 text-dark"><i class="fa fa-calendar-alt text-primary text-dark"></i><?=' '. date("d M Y", $each_news->published_at) ?></p>
            </div>
            <h5 class="mb-3"><?= $each_news->title ?></h4>
              <p class="mb-4">
                <?= strlen(strip_tags($each_news->description)) > 80 ? substr(strip_tags($each_news->description), 0, 80) . '...' : substr(strip_tags($each_news->description), 0, 80) ?>
              </p>
              <a class="btn btn-light px-3" href="<?= $each_news->subtitle ? $each_news->subtitle:''?>" target="_blank">Read More</a>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>
<!-- product End -->