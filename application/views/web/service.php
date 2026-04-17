<!-- Title Bar -->
<?php 
if ($service->id == 1) {
    $image = "solar-system-installation.jpg";
} else if ($service->id == 2) {
    $image = "header7.jpg";
} else if ($service->id == 3) {
    $image = "header8.jpg";
} else {
    $image = "header6.jpg"; // fallback if needed
}
?>

<div class="pbmit-title-bar-wrapper"
     style="background-image: url('<?= base_url("assets/web/images/$image") ?>')">


    <div class="container">
        <div class="pbmit-title-bar-content">
            <div class="pbmit-title-bar-content-inner">
                <div class="pbmit-tbar">
                    <div class="pbmit-tbar-inner container">
                        <h1 class="pbmit-tbar-title">Services</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Title Bar End-->

<!-- Page Content -->
<div class="page-content">
    <!-- Page Breadcramp -->
    <section class="brd">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb header-bradcrumb">
                        <li style="text-align: center">
                            <a href="<?= base_url() ?>">Home</a>
                        </li>
                        <li>---</li>

                        <li style="text-align: center">
                            <a href="<?= base_url() ?>#services">Services</a>
                        </li>
                        <li>---</li>

                        <li class="active"><?= $service->name ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page Breadcramp -->

    <!-- About Start -->
    <section class="section-xl">
        <div class="container">
            <div class="row g-0">
                <div
                    class="col-md-12 col-xl-6"
                    data-aos="fade-up"
                    data-aos-duration="800">
                    <div class="about-one">
                        <div class="about-img">
                            <img
                                src="<?= base_url('assets/uploads/bio/' . $service->desc_img) ?>"
                                class="img-fluid"
                                alt="" />
                        </div>
                    </div>
                </div>
                <div
                    class="col-md-12 col-xl-6"
                    data-aos="fade-up"
                    data-aos-duration="800"
                    data-aos-delay="300">
                    <div class="about-one-rightbox">
                        <div class="pbmit-heading-subheading">
                            <h2 class="pbmit-title"><?= $service->name ?></h2>
                        </div>
                        <p><?= $service->short_desc ?>
                        </p>

                        <div class="row align-items-center">
                            <div class="col-md-12 list-group-col">
                                <?php if ($service->formatted_desc) { ?>
                                    <?= $service->formatted_desc ?>
                                <?php } ?>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Start -->

    <!-- Service Start -->
    <?php if ($services) { ?>
        <section class="section-mdb" data-aos="fade-up" data-aos-duration="800">
            <div class="container">
                <div class="pbmit-heading-subheading text-center">
                    <h2 class="pbmit-title">Our Services</h2>
                </div>
                <div class="row pbminfotech-gap-40px justify-content-center">
                    <?php foreach (array_reverse($services) as $key => $service) { ?>
                        <article class="pbmit-service-style-3 col-md-6 col-lg-4">
                            <a href="<?= base_url('services/info/') . $service->title_slug ?>">
                                <div class="pbminfotech-post-item">
                                    <div class="pbmit-box-content-wrap">
                                        <div class="pbmit-service-image-wrapper">
                                            <div class="pbmit-featured-img-wrapper">
                                                <div class="pbmit-featured-wrapper">
                                                    <img src="<?= base_url('assets/uploads/bio/' . $service->additional_img) ?>" class="img-fluid" alt="<?= $service->name ?>">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="pbmit-content-box d-flex">
                                            <div class="pbminfotech-box-number"><?= ++$key ?></div>

                                            <h3 class="pbmit-service-title">
                                                <?= $service->name ?>
                                            </h3>

                                        </div>
                                    </div>
                                </div>
                            </a>
                        </article>
                    <?php } ?>

                </div>
            </div>
        </section>
    <?php } ?>



    <!-- Service End -->
</div>
<!-- Page Content End -->