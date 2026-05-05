<!-- Title Bar -->
<div
  class="pbmit-title-bar-wrapper"
  style="background-image: url('<?= base_url('assets/web/images/header1.jpg') ?>')">
  <div class="container">
    <div class="pbmit-title-bar-content">
      <div class="pbmit-title-bar-content-inner">
        <div class="pbmit-tbar">
          <div class="pbmit-tbar-inner container">
            <h1 class="pbmit-tbar-title">Privacy Policy</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Title Bar End-->
<!-- Page Content -->
<div class="page-content">
  <section class="brd">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <ol class="breadcrumb header-bradcrumb">
            <li style="text-align: center">
              <a href="<?= base_url() ?>">Home</a>
            </li>
            <li>---</li>

            <li class="active">Privacy Policy</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="about">
    <div class="container">
      <div class="row">
        <div class="col-md-12 m-5">
          <h2><?= $privacy_policy->title ?></h2>

          <?php if ($privacy_policy->short_desc) { ?>
            <p><?= $privacy_policy->short_desc ?>
            </p>
          <?php } else { ?>
            <p>Coming soon</p>
          <?php } ?>
        </div>


      </div>
    </div>
  </section>


  <!-- End section -->
</div>
<!-- Page Content End -->