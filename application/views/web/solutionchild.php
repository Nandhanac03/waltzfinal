<!-- Inner page banner start -->
<?php
if ($solution->title_slug == 'solar-on-wheels') {
    $header = 'solar-on-wheels.jpg.jpeg';
}else if( $solution->title_slug == 'cell-on-wheels') {
    $header = 'cell-on-wheels.jpg';
}
else if( $solution->title_slug == 'battery-on-wheels') {
    $header = 'BESS.jpg.jpeg';
}
else if( $solution->title_slug == 'precision-cooling') {
    $header = 'precision-cooling.jpg';
}
else if( $solution->title_slug == 'cooling-retrofit') {
    $header = 'retrofit.jpg';
}
else if( $solution->title_slug == 'renewable-energy') {
    $header = 'solar-system-installation.jpg';
}





else{
    $header = 'banner4.jpg';
}
?>

<div class="pbmit-title-bar-wrapper" >
    <div class="container">
        <div class="pbmit-title-bar-content">
            <div class="pbmit-title-bar-content-inner">
                <div class="pbmit-tbar">
                    <div class="pbmit-tbar-inner container">
                        <h1 class="pbmit-tbar-title"> <?= $solution->title ?></h1>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Inner page banner end -->

<!-- Page Content -->
<div class="page-content">


    <!-- Page Breadcramp -->
    <section class="brd">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb header-bradcrumb">
                        <li style="text-align: center;"><a href="<?= base_url() ?>">Home</a></li>
                        <li>---</li>
                        <li style="text-align: center;"><a href="<?= base_url() ?>#solutions">Solutions</a></li>
                        <li>---</li>
                        <li class="active"><?= $solution->title ?></li>
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
                        <?php if ($solution->cover_img) { ?>

                            <div class="col-md-12 justify-content-center"><img src="<?= base_url('assets/uploads/solution/' . $solution->cover_img) ?>"
                                    alt="Solar" class="img-fluid sol-img">
                            </div>
                        <?php } ?>

                        <div class="pbmit-custom-heading">
                            <h3 class="pbmit-title"><?= $solution->title ?></h3>
                        </div>

                        <?php if (empty($solution->formatted_description) && empty($solution->formatted_short_desc)) { ?>
                            <p>Coming Soon</p>
                        <?php } ?>

                        <?php
                        $formatted_description = $solution->description;
                        if ($formatted_description != '') {
                            // Check if content contains <ul>
                            if (strpos($formatted_description, "<ul>") !== false) {
                                // Replace <ul>
                                $formatted_description = str_replace("<ul>", '<ul class="list-group">', $formatted_description);

                                // Replace <li> with new icon + text structure
                                if (strpos($formatted_description, "<li>") !== false) {
                                    $formatted_description = preg_replace(
                                        '/<li>(.*?)(<\/li>)/',
                                        '<li class="list-group-item"><span class="pbmit-icon-list-icon"><i
                                                        class="pbmit-solaar-icon pbmit-solaar-icon-verified"></i></span><span
                                                    class="pbmit-icon-list-text">$1</span></li>',
                                        $formatted_description
                                    );
                                }
                            } else {
                                // Wrap non-list content in a formatted div
                                $formatted_description = '<div class="formatted-text">' . $formatted_description . '</div>';
                            }
                        }

                        ?>
                        <p> <?= $solution->formatted_short_desc ?>
                        </p>
                        <div class="row">
                            <div class="col-md-12">

                                <p><?= $formatted_description ?></p>
                            </div>

                        </div>

                        <!-- Portfolio Start -->
                        <?php if ($solution_images) { ?>
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
                                    <div class="swiper-slider pbminfotech-gap-0px" data-arrows-class="portfolio-arrow"
                                        data-autoplay="true" data-loop="true" data-dots="false" data-arrows="true"
                                        data-columns="4" data-margin="0" data-effect="slide">
                                        <div class="swiper-wrapper">
                                            <!-- Slide1 -->
                                            <?php foreach ($solution_images as $key => $s_img) { ?>
                                                <article class="pbmit-portfolio-style-1 swiper-slide">
                                                    <div class="pbminfotech-post-content">
                                                        <div class="pbmit-featured-img-wrapper">
                                                            <div class="pbmit-featured-wrapper">
                                                                <img src="<?= base_url('assets/uploads/solution/' . $s_img->file) ?>" class="img-fluid"
                                                                    alt="solutions">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </article>
                                            <?php } ?>



                                        </div>
                                    </div>
                                </div>
                            </section>
                        <?php } ?>
                        <!-- Portfolio End -->
                    </div>
                </div>



                <div class="col-md-3 service-right-col sidebar order-xl-2 order-md-2 order-1" id="primary">


                    <?php if ($solution_documents) { ?>
                        <aside class="widget pbmit-download-info order-2 ">
                            <h2 class="widget-title">Download Brochures</h2>
                            <div class="pbmit-download">
                                <?php foreach ($solution_documents as $document) { ?>

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


                    <aside class="service-sidebar item1">
                        <?php if ($allsolution_categories) {  ?>

                            <aside class="widget post-list">
                                <h2 class="widget-title">Our solutions</h2>
                                <div class="all-post-list">
                                    <!-- <ul>
                                        <?php
                                        // Step 1: collect all parent_ids (these are IDs of items that have children)
                                        $parent_ids = array_map(fn($x) => $x->parent_id, $allsolution_categories);

                                        // Step 2: loop and skip parents
                                        foreach ($allsolution_categories as $item) {

                                            // If this item's id appears in the list of parent_ids, it means it has children → skip
                                            if (in_array($item->id, $parent_ids)) {
                                                continue;
                                            }

                                        ?>
                                            <li><a href="<?= base_url('solution/info/') . $item->title_slug ?>"><?= $item->title ?></a></li>
                                        <?php } ?>
                                    </ul> -->
                                    <?php
                                    // Convert array to simple array for easy sorting
                                    $categories = $allsolution_categories;

                                    // Step 1: Find all parent IDs that actually have children
                                    $parent_ids_with_children = [];
                                    foreach ($categories as $c) {
                                        if ($c->parent_id != 0) {
                                            $parent_ids_with_children[$c->parent_id] = true;
                                        }
                                    }

                                    // Step 2: Separate child categories and standalone main categories
                                    $child_categories = [];
                                    $standalone_main = [];

                                    foreach ($categories as $c) {

                                        // If this is a child category → collect it under its parent
                                        if ($c->parent_id != 0) {
                                            $child_categories[$c->parent_id][] = $c;
                                        }
                                        // If this is a main category and has no children → collect as standalone
                                        else if (!isset($parent_ids_with_children[$c->id])) {
                                            $standalone_main[] = $c;
                                        }
                                    }

                                    // Step 3: Sort each group of child categories by category_order ASC
                                    foreach ($child_categories as $parent => &$items) {
                                        usort($items, function ($a, $b) {
                                            return $a->category_order <=> $b->category_order;
                                        });
                                    }

                                    ?>

                                    <ul>
                                        <?php
                                        // Step 4: Output child categories first (sorted)
                                        foreach ($child_categories as $parent => $children) {
                                            foreach ($children as $item) {
                                                echo '<li><a href="' . base_url('solution/info/') . $item->title_slug . '">' . $item->title . '</a></li>';
                                            }
                                        }

                                        // Step 5: Output standalone main categories (those with no children)
                                        foreach ($standalone_main as $item) {
                                            echo '<li><a href="' . base_url('solution/info/') . $item->title_slug . '">' . $item->title . '</a></li>';
                                        }
                                        ?>
                                    </ul>

                                </div>
                            </aside>
                        <?php } ?>

                        <!-- <?php if ($solution_documents) { ?>

                            <aside class="widget pbmit-download-info desktop-1">
                                <h2 class="widget-title">Download Brochures</h2>
                                <div class="pbmit-download">
                                    <?php foreach ($solution_documents as $document) { ?>

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


                        <?php if ($solution->note) { ?>
                            <aside class="widget pbmit-download-info position-relative co-box">
                                <!-- <h2 class="widget-title">Contact Us</h2> -->
                                <div class="pbmit-button-box ">
                                    <p><?= $solution->note ?></p>
                                    <a href="<?= base_url('contact_us') ?>#contact-form-section"
                                        class="pbmit-btn ">
                                        <span class="pbmit-button-text">Contact Us</span>
                                    </a>

                                </div>
                            </aside>
                        <?php } ?>
                    </aside>
                </div>

            </div>
        </div>
    </section>
    <!-- Service Details End -->




</div>
<!-- Page Content End -->