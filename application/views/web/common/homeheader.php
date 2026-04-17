<div class="page-wrapper" id="page">
	<!-- Header Main Area -->
	<header class="site-header pbmit-header-style-2 <?= ($active_menu == 'home') ? 'home-header' : 'inner-header' ?>" id="masthead">
		<div class="pbmit-header-overlay clearHeader">
			<div class="pbmit-main-header-area newhome">
				<div class="pbmit-header-content">
					<div class="container-fluid">
						<div
							class="pbmit-header-content d-flex align-items-center justify-content-between">
							<div class="pbmit-header-menu-area d-flex align-items-center">
								<div class="pbmit-logo-area">
									<div class="site-branding">
										<h1 class="site-title newhome">
											<a href="<?= base_url() ?>">
												<img
													class="logo-img"
													src="<?= base_url('assets/web/images/logo.png') ?>"
													alt="Solar" />
											</a>
										</h1>
									</div>
								</div>
								<div
									class="pbmit-menuarea d-flex justify-content-between align-items-center">
									<div class="site-navigation">
										<nav class="main-menu pbmit-navbar newhome">
											<div>
												<ul id="pbmit-top-menu data" class="navigation clearfix newheader">
													<li class="<?= $active_menu == 'home' ? 'active' : '' ?>">
														<a href="<?= base_url() ?>">Home</a>
													</li>

													<li class="<?= $active_menu == 'about' ? 'active' : '' ?>"><a href="<?= base_url('about') ?>">About Us</a></li>


													<li class="dropdown <?= $active_menu == 'solution' ? 'active' : '' ?>">
														<a href="#">Solutions</a>
														<ul>
															<?php foreach ($allsolution_categories as $parent): ?>
																<?php if ($parent->parent_id == 0): // only top-level categories 
																?>
																	<?php
																	// find children
																	$children = array_filter($allsolution_categories, function ($cat) use ($parent) {
																		return $cat->parent_id == $parent->id;
																	});
																	?>

																	<?php if (!empty($children)): ?>
																		<li class="dropdown">
																			<a href="#">
																				<?= $parent->title ?>
																			</a>
																			<ul class="sub-menu">
																				<?php foreach ($children as $child): ?>
																					<li>
																						<a href="<?= base_url('solution/info/' . $child->title_slug) ?>">
																							<?= $child->title ?>
																						</a>
																					</li>
																				<?php endforeach; ?>
																			</ul>
																		</li>
																	<?php else: ?>
																		<li>
																			<a href="<?= base_url('solution/info/' . $parent->title_slug) ?>">
																				<?= $parent->title ?>
																			</a>
																		</li>
																	<?php endif; ?>
																<?php endif; ?>
															<?php endforeach; ?>
														</ul>
													</li>


													<?php if ($products) { ?>
														<li class="dropdown <?= $active_menu == 'product' ? 'active' : '' ?>">
															<a href="#">Products</a>
															<ul>
																<?php foreach ($products as $product) { ?>
																	<li>
																		<a href="<?= base_url('product/info/' . $product->title_slug) ?>"><?= $product->product_name ?></a>
																	</li>
																<?php } ?>
															</ul>
														</li>
													<?php } ?>
													<?php if ($services) { ?>
														<li class="dropdown <?= $active_menu == 'service' ? 'active' : '' ?>">
															<a href="#">Services</a>
															<ul>
																<?php foreach (array_reverse($services) as $service) { ?>
																	<li>
																		<a href="<?= base_url('services/info/') . $service->title_slug ?>"><?= $service->name ?></a>
																	</li>
																<?php } ?>


															</ul>
														</li>
													<?php } ?>

												</ul>
											</div>
										</nav>
									</div>
								</div>
							</div>

							<!--<div class="pbmit-header-search-btn">
									<a href="#" title="Search">
										<i class="pbmit-base-icon-search-1"></i>
									</a>
								</div>-->

							<div class="pbmit-right-box d-flex align-items-center">
								<?php if ($active_menu != 'contact') { ?>
									<div class="pbmit-button-box">
										<a href="<?= base_url('contact_us') ?>" class="pbmit-btn">
											<span class="pbmit-button-text">Contact Us</span>
										</a>
									</div>
								<?php } ?>
								<div class="pbmit-burger-menu-wrapper">
									<div class="pbmit-mobile-menu-bg"></div>
									<button class="nav-menu-toggle" id="menu-toggle">
										<i class="pbmit-base-icon-menu-1"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>