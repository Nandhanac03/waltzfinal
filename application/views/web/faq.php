<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs p-4">
        <div class="container">
            <ol>
                <li><a href="index.html">Home</a></li>
                <li>FAQ</li>
            </ol>
            <h2>FAQ</h2>
        </div>
    </section><!-- End Breadcrumbs -->


    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq">
        <div class="container" data-aos="fade-up">
            <header class="section-header">
                <h2>F.A.Q</h2>
                <p>Frequently Asked Questions</p>
            </header>

            <div class="row">
                <div class="col-lg-12">
                    <!-- F.A.Q List 1-->
                    <div class="accordion accordion-flush" id="faqlist1">
                        <?php if ($faq) {
                            foreach ($faq as $key=>$questions) { ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-<?=$key ?>">
                                            <?=$questions->title ?>
                                        </button>
                                    </h2>
                                    <div id="faq-content-<?=$key ?>" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                                        <div class="accordion-body">
                                        <?=$questions->short_desc ?>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>

            </div>
        </div>
    </section><!-- End F.A.Q Section -->

</main><!-- End #main -->