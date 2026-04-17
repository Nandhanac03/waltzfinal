

<!-- Inner page banner -->
 <?php
$banner = "assets/web/images/banner3.jpg";

if ($product->title_slug == "teltonika-routers") {
    $banner = "assets/web/images/inner/teltonika.jpg";
} elseif ($product->title_slug == "battery") {
    $banner = "assets/web/images/inner/batteries.jpg.jpeg";
}
elseif ($product->title_slug == "pv-panels") {
    $banner = "assets/web/images/inner/solar-system-installation.jpg";
}
elseif ($product->title_slug == "micro-inverters") {
    $banner = "assets/web/images/inner/solar-system-installation.jpg";
}
elseif ($product->title_slug == "free-cooling-systems") {
    $banner = "assets/web/images/inner/aircon-free-cooling.jpg";
}
elseif ($product->title_slug == "racks-and-cabinets") {
    $banner = "assets/web/images/inner/header1.jpeg";
}
elseif ($product->title_slug == "air-conditioners") {
    $banner = "assets/web/images/inner/aircon-free-cooling.jpg";
}
?>




 <div class="pbmit-title-bar-wrapper" >
    <div class="container">
        <div class="pbmit-title-bar-content">
            <div class="pbmit-title-bar-content-inner">
                <div class="pbmit-tbar">
                    <div class="pbmit-tbar-inner container">
                        <h1 class="pbmit-tbar-title"> <?= $product->product_name ?></h1>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

 <!-- Inner page banner -->

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
 							<a href="<?= base_url() ?>#products">Products</a>
 						</li>
 						<li>---</li>

 						<li class="active"><?= $product->product_name ?></li>
 					</ol>
 				</div>
 			</div>
 		</div>
 	</section>
 	<!-- End Page Breadcramp -->

 	<!-- Service Details -->
 	<section class="site-content service-details">
 		<div class="container">
 			<div class="row">
 				<div class="col-md-9 service-left-col order-xl-1 order-md-1 order-2" id="secondary">
 					<div class="pbmit-entry-content">


 						<?php if ($product->product_cover) { ?>

 							<div class="col-md-12 justify-content-center"><img src="<?= base_url('assets/uploads/product/' . $product->product_cover) ?>"
 									alt="Solar" class="img-fluid sol-img">
 							</div>
 						<?php } ?>

 						<div class="pbmit-custom-heading">
 							<h3 class="pbmit-title"><?= $product->product_name ?></h3>
 						</div>
 						<?php if (empty($product->short_desc) && empty($product->formatted_desc) && empty($product->product_images)) { ?>
 							<p>Coming Soon</p>
 						<?php } ?>
 						<p><?= $product->short_desc ?></p>




 						<div class="row">
 							<div class="col-md-12">

 								<p><?= $product->formatted_desc ?></p>
 							</div>







 						</div>

 						<!-- Portfolio Start -->
 						<?php if ($product_images) { ?>
 							<section class="portfolio-section-inner-p" data-aos="fade-up" data-aos-duration="800">
 								<div class="container">
 									<div class="d-flex align-items-center justify-content-between">
 										<div class="pbmit-heading-subheading">

 											<h2 class="pbmit-title">Our Products</h2>
 										</div>
 										<div class="d-inline-flex portfolio-arrow"></div>
 									</div>
 								</div>
 								<div class="container-fluid p-0">
 									<div class="swiper-slider pbminfotech-gap-0px" data-arrows-class="portfolio-arrow" data-autoplay="true" data-loop="true" data-dots="false" data-arrows="true" data-columns="4" data-margin="0" data-effect="slide">
 										<div class="swiper-wrapper">
 											<!-- Slide1 -->
 											<?php foreach ($product_images as $images) { ?>
 												<article class="pbmit-portfolio-style-1 swiper-slide">
 													<div class="pbminfotech-post-content">
 														<div class="pbmit-featured-img-wrapper">
 															<div class="pbmit-featured-wrapper">
 																<img src="<?= base_url('assets/uploads/product/' . $images->file) ?>" class="img-fluid" alt="solutions">
 															</div>
 														</div>

 													</div>
 												</article>
 											<?php } ?>
 										</div>
 									</div>
 								</div>
 							</section>
 							<!-- Portfolio End -->
 						<?php } ?>

 					</div>
 				</div>



 				<div class="col-md-3 service-right-col sidebar order-xl-2 order-md-2 order-1" id="primary">
 					<?php if ($product_documents) { ?>

 						<aside class="widget pbmit-download-info order-2 ">
 							<h2 class="widget-title">Download Brochures</h2>
 							<div class="pbmit-download">
 								<?php foreach ($product_documents as $document) { ?>

 									<div class="pbmit-item-download">
 										<a href="<?= base_url('assets/uploads/document/' . $document->file) ?>"
 											target="_blank" rel="noopener">
 											<span class="pbmit-download-content">
 												<i class="pbmit-base-icon-document-1"></i> <?= $document->title ?> Brochure
 											</span>
 											<span class="pbmit-download-item">
 												<i
 													class="pbminfotech-base-icons pbmit-righticon pbmit-base-icon-download"></i>
 											</span>
 										</a>
 									</div>
 								<?php } ?>

 							</div>
 						</aside>
 					<?php } ?>
                  
                  
                  
                  <?php if ($product->note) { ?>
 								<aside class="widget pbmit-download-info position-relative co-box">
 									<!-- <h2 class="widget-title">Contact Us</h2> -->
 									<div class="pbmit-button-box">
 										<p><?= $product->note ?></p>
 										<a href="<?= base_url('contact_us') ?>#contact-form-section"
 											class="pbmit-btn">
 											<span class="pbmit-button-text">Request a quote</span>
 										</a>
 									</div>
 								</aside>
 							<?php } ?>


 					<?php if ($products) { ?>
 						<aside class="service-sidebar item1">
 							<aside class="widget post-list">
 								<h2 class="widget-title">Our Products</h2>
 								<div class="all-post-list">
 									<ul>
 										<?php foreach ($products as $item) { ?>
 											<li><a href="<?= base_url('product/info/') . $item->title_slug ?>"><?= $item->product_name ?></a></li>
 										<?php } ?>

 									</ul>
 								</div>
 							</aside>
 							<!-- <?php if ($product_documents) { ?>

 								<aside class="widget pbmit-download-info desktop-1">
 									<h2 class="widget-title">Download Brochures</h2>
 									<div class="pbmit-download">
 										<?php foreach ($product_documents as $document) { ?>

 											<div class="pbmit-item-download">
 												<a href="<?= base_url('assets/uploads/document/' . $document->file) ?>"
 													target="_blank" rel="noopener">
 													<span class="pbmit-download-content">
 														<i class="pbmit-base-icon-document-1"></i> <?= $document->title ?> Brochure
 													</span>
 													<span class="pbmit-download-item">
 														<i
 															class="pbminfotech-base-icons pbmit-righticon pbmit-base-icon-download"></i>
 													</span>
 												</a>
 											</div>
 										<?php } ?>



 									</div>
 								</aside>
 							<?php } ?> -->

 							
 						</aside>
 					<?php } ?>

 				</div>
 			</div>
 		</div>
 	</section>
 	<!-- Service Details End -->
 </div>
 <!-- Page Content End -->