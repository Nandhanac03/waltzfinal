<!-- Title Bar -->
<div class="pbmit-title-bar-wrapper" >
	<div class="container">
		<div class="pbmit-title-bar-content">
			<div class="pbmit-title-bar-content-inner">
				<div class="pbmit-tbar">
					<div class="pbmit-tbar-inner container">
						<h1 class="pbmit-tbar-title"> About Us</h1>
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

						<li style="text-align: center;"><a href="<?= base_url() ?>">Home</a></li>
						<li>---</li>

						<li class="active">About Us</li>

					</ol>

				</div>

			</div>

		</div>

	</section>




	<section class="about-shot-info section-sm">
		<div class="container">
			<div class="row">
				<div class="col-md-6 mt-20">
					<h2><?= $about->title ?></h2>
					<p><?= $about->short_desc ?>
					</p>
				</div>
				<div class="col-md-6">
					<img class="img-fluid" src="<?= base_url('assets/uploads/page/' . $about->desc_img) ?>" alt="">
				</div>
			</div>
		</div>
	</section>



	<section class="team" id="team">

		<div class="container">
			<div class="row">
				<!-- team member -->
				<?php if ($vision) { ?>

					<div class="offset-lg-1 col-md-5 col-sm-6 ">

						<div class="team-member">

							<div class="member-photo">

								<!-- member photo -->

								<img class="img-fluid" src="<?= base_url('assets/uploads/page/' . $vision->desc_img) ?>">

								<!-- /member photo -->

							</div>



							<!-- member name & designation -->

							<div class="member-content">

								<h3>Our Vision</h3>

								<p><?= $vision->short_desc ?></p>

							</div>

							<!-- /member name & designation -->



						</div>

					</div>
				<?php } ?>

				<!-- end team member -->



				<!-- team member -->
				<?php if ($mission) { ?>

					<div class="col-md-5 col-sm-6 ">

						<div class="team-member ">

							<div class="member-photo">

								<!-- member photo -->

								<img class="img-fluid" src="<?= base_url('assets/uploads/page/' . $mission->desc_img) ?>">

								<!-- /member photo -->



							</div>



							<!-- member name & designation -->

							<div class="member-content">

								<h3>Our Mission</h3>

								<p>
									<?= $mission->subtitle ?>
								</p>

								<?php
								$missionArray = [];
								if ($mission->short_desc) {
									$mission->short_desc  = str_replace(['<ul>', '</ul>'], '',  $mission->short_desc);
									$mission->short_desc  = str_replace('</li>', '',  $mission->short_desc);
									$missionArray = explode('<li>',  $mission->short_desc);
									$missionArray = array_filter(array_map('trim', $missionArray));
								}
								?>
								<ul class="checklist">
									<?php if (!empty($missionArray)) { ?>
										<?php foreach ($missionArray as $data) { ?>

											<li>
												<?= $data ?>
											</li>

										<?php } ?>
									<?php } ?>

								</ul>

							</div>

							<!-- /member name & designation -->

						</div>

					</div>
				<?php } ?>

				<!-- end team member -->





			</div> <!-- End row -->

		</div> <!-- End container -->

	</section>



	<?php if ($core_value) { ?>


		<section class="about-2 section white " id="about">

			<div class="container">

				<div class="row">



					<!-- section title -->

					<div class="col-12">

						<div class="title text-center">

							<h2>Our Core Values</h2>

						</div>

					</div>

					<!-- /section title -->



					<div class="col-md-6">

						<img src="<?= base_url('assets/uploads/page/' . $core_value->desc_img) ?>" class="img-fluid" alt="">

					</div>

					<div class="col-md-6">

					<?php
						$core_valueArray = [];
						if ($core_value->short_desc) {
							$core_value->short_desc  = str_replace(['<ul>', '</ul>'], '',  $core_value->short_desc);
							$core_value->short_desc  = str_replace('</li>', '',  $core_value->short_desc);
							$core_valueArray = explode('<li>',  $core_value->short_desc);
							$core_valueArray = array_filter(array_map('trim', $core_valueArray));
						}
						?>
						<ul class="checklist">
							<?php if (!empty($core_valueArray)) { ?>
								<?php foreach ($core_valueArray as $data) { ?>
									<li>
										<?= $data ?>
									</li>
								<?php } ?>
							<?php } ?>

						</ul>

					</div>

				</div> <!-- End row -->

			</div> <!-- End container -->

		</section> <!-- End section -->
	<?php } ?>



</div>
<!-- Page Content End -->