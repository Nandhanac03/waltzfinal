<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs p-4">
        <div class="container">
            <ol>
                <li><a href="<?= base_url('home') ?>">Home</a></li>
                <li>Careers</li>
            </ol>
            <h2>Careers</h2>
        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Our careers Section✅ ======= -->
    <section id="career-page" class="career-page pt-5">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <p>Why work with us</p>
            </div>
            <div class="row gy-5">
                <?php if ($why_work_with_us) {
                    $data_aos_delay = 100;
                    foreach ($why_work_with_us as $key => $each_work) { ?>
                        <div class="col-lg-4 col-md-6 service-item d-flex flex-wrap" data-aos="fade-up" data-aos-delay="<?= $data_aos_delay * ($key + 1) ?>">
                            <div class="icon flex-shrink-0"><i class="bi bi-briefcase"></i></div>
                            <div>
                                <h4 class="title"><a href="#" class="stretched-link"><?= $each_work->title ?></a></h4>
                                <p class="description"><?= $each_work->short_desc ?></p>
                            </div>
                        </div>
                        <!-- End careers Item -->
                <?php }
                } ?>
            </div>
        </div>
    </section><!-- End Our careers Section -->


    <!-- ======= Our careers list Section ======= -->
    <section id="career" class="career pt-0">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <p>Openings</p>
            </div>
            <div class="row posts-list">
                <?php if ($jobs) {
                    foreach ($jobs as $job) { ?>
                        <div class="col-lg-6 mb-5">
                            <article class="d-flex flex-column">
                                <h2 class="title">
                                    <a href=""><?= $job->title ?></a>
                                </h2>
                                <div class="meta-top">
                                    <?= $job->location ?>
                                </div>
                                <div class="meta-top">
                                    <?= $job->sector ?>
                                </div>
                                <div class="content">
                                    <p>
                                        <?= $job->short_desc ?>
                                    </p>
                                    <ul>
                                        <?= $job->description ?>
                                    </ul>
                                </div>
                                <div class="read-more mt-auto align-self-start">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Apply Now<i class="bi bi-arrow-right"></i></a>
                                </div>
                            </article>
                        </div>
                <?php }
                } ?>

            </div>
        </div>
    </section> <!-- End Our careers list Section -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apply Now</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="" id="response">

                </div>
                <div class="modal-body">
                    <form method="post" id="apply_job" action="<?= base_url('career/job_form') ?>" enctype="multipart/form-data">
                        <div class="mb-3">
                            <select class="form-select" name="job_category" aria-label="Default select example" id="jobCategory">
                                <option value="" selected>Job Categories</option>
                                <?php if ($job_titles) {
                                    foreach ($job_titles as $job) { ?>
                                        <option value="<?= $job->id ?>"><?= $job->title ?></option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                        <!-- <input type="text" id="hidden_category_title"> -->

                        <div class="mb-3">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                        </div>


                        <div class="mb-3">
                            <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                        </div>

                        <div class="mb-3">
                            <input type="Number" class="form-control" name="phone" id="phone" placeholder="Mobile Number (Eg: 971xxxxxxxxxxxx)">
                        </div>

                        <div class="mb-3">
                            <div class="input-group custom-file-button">
                                <label class="input-group-text" for="resume">Upload CV</label>
                                <input type="file" class="form-control" id="resume" name="resume" accept=".pdf,.doc,.docx">
                            </div>
                            <p class="text-danger"><i>upload only pdf (max file size: 1MB)</i></p>
                        </div>

                        <div class="mb-3">
                            <textarea class="form-control" id="messageText" placeholder="Message" name="message"></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn-1" id="modal_send">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main><!-- End #main -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    // let cat_id=$("#apply_now").data("job-category-id")
    // $("#hidden_category_title").val(cat_id)

    $("#apply_job").submit(function(e) {
        e.preventDefault();
        let job = $("#jobCategory").val();
        let name = $("#name").val();
        let email = $("#email").val();
        let phone = $("#phone").val();
        let message = $("#messageText").val();
        var formData = new FormData(this);
        $.ajax({
            type: 'post',
            url: "<?= base_url('career/job_form') ?>",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(response) {
                if (response.error) {
                    let res = '<div class="alert alert-danger m-1 alert-dismissible " role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'
                    if (response.name_error != '' && response.name_error != undefined) {
                        res += response.name_error
                    }
                    if (response.phone_error != '' && response.phone_error != undefined) {
                        res += response.phone_error
                    }
                    if (response.email_error != '' && response.email_error != undefined) {
                        res += response.email_error
                    }
                    if (response.job_error != '' && response.job_error != undefined) {
                        res += response.job_error
                    }
                    if (response.resume_error != '' && response.resume_error != undefined) {
                        res += response.resume_error
                    }
                    if (response.resume_size_error != '' && response.resume_size_error != undefined) {
                        res += response.resume_size_error
                    }
                    res += '</div>'
                    $("#response").html(res)
                } else {
                    if (response.success) {
                        let res = '<div class="alert alert-success m-1 alert-dismissible " role="alert"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button><i class="bi bi-send-check-fill me-2"></i>Your Job application sent successfully.</div>'
                        $("#response").html(res)
                        $("#name").val("")
                        $("#email").val("")
                        $("#phone").val("")
                        $("#jobCategory").val("")
                        $("#messageText").val("")
                        $("#resume").val("")
                    }
                }
            }
        })
    })

    $(".btn-close").click(function() {
        $("#response").html("")
        $("#name").val("")
        $("#email").val("")
        $("#phone").val("")
        $("#jobCategory").val("")
        $("#messageText").val("")
        $("#resume").val("")
    })
</script>