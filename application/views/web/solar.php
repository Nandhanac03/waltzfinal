     <!-- Page Header Start -->
     <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
       <div class="container text-center py-5 mt-4">
         <h1 class="display-2 text-white mb-3 animated slideInDown">Solar Systems</h1>

       </div>
     </div>
     <!-- Page Header End -->


     <!-- About Start -->
     <div class="container-fluid about py-1">
       <div class="container">

         <!-- Row start -->
         <div class="row align-items-center">
           <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
             <div>
               <img src="<?= base_url('assets/uploads/page/' . $solacontent->desc_img) ?>" class="img-fluid w-100" style="object-fit: cover;" alt="Solar System">
             </div>
           </div>
           <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.4s">
             <div class="section-title text-start mb-5">
               <h4 class="sub-title pe-3 mb-0"><?= $solacontent->title ?></h4>
               <h1 class="mb-4 mt-4"><?= $solacontent->subtitle ?></h1>
               <p class="mb-4 text-justify">
                 <?= $solacontent->short_desc ?></p>
               <a href="<?= base_url('projects')?>" class="btn btn-primary text-white py-2 px-4"> Our projects and expertise</a>
             </div>
           </div>
         </div> <!-- Row End -->




       </div>
     </div>
     <!-- About End -->



     <!-- ======= vision Section ======= -->
     <div id="application" class="application solar-bg mt-3">
       <div class="container">

         <div class="section-title text-center">

           <h1 class="mb-4 mt-0 text-white"> <?= $applications->subtitle ?> </h1>
         </div>


         <div class="row gy-4">

           <div class="col-md-8 col-sm-12 mt-4">

             <div class="row">


               <?php if (!empty($applications->available_solar_solutions)) { ?>
                 <?php foreach ($applications->available_solar_solutions as $items) { ?>
                   <?php if (!empty($items)) {
                    ?>
                     <div class="col-sm-6">
                       <div class="icon-list1 d-flex align-items-center">
                         <i><img src="<?= base_url('assets/web/img/icon-7.png') ?>" alt="solar"></i>
                         <span><?= $items?></span>
                       </div>
                     </div><!-- End Icon List Item-->
                   <?php } ?>
                 <?php } ?>
               <?php } ?>

             </div>
           </div>

           <div class="solar-img d-none d-md-block col-md-4">

             <img src="<?= base_url('assets/uploads/page/' . $applications->desc_img) ?>" alt="solar" class="img-fluid rounded">
           </div>


         </div>

       </div>
     </div><!-- End application Section -->