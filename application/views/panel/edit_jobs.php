<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Career</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/jobs/all') ?>">Careers</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <?= $alert ?>
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Edit</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="<?= site_url('panel/jobs/edit/' . $job->id) ?>" enctype="multipart/form-data" id="jobsForm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="jobsTitle">Job Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="jobsTitle" placeholder="Title" name="jobsTitle" value="<?= set_value('jobsTitle', empty($job->title) ? '' : $job->title) ?>" onchange="generate_slug_title(this, 'jobsSlugTitle')">
                                        <?php echo form_error('jobsTitle'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_jobs_slug_title'] != TRUE) : ?>
                                        <div class="form-group col-sm-12" style="display: none;">
                                            <label for="jobsSlugTitle">Slug Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="jobsSlugTitle" placeholder="Slug Title" name="jobsSlugTitle" value="<?= set_value('jobsSlugTitle', empty($job->title_slug) ? '' : $job->title_slug) ?>">
                                            <?php echo form_error('jobsSlugTitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_jobs_location'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="jobsLocation">Job Location</label>
                                            <input type="text" class="form-control" id="jobsLocation" placeholder="Location" name="jobsLocation" value="<?= set_value('jobsLocation', empty($job->location) ? '' : $job->location) ?>">
                                            <?php echo form_error('jobsLocation'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_jobs_sector'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="jobsSector">Job Sector</label>
                                            <input type="text" class="form-control" id="jobsSector" placeholder="Job Sector" name="jobsSector" value="<?= set_value('jobsSector', empty($job->sector) ? '' : $job->sector) ?>">
                                            <?php echo form_error('jobsSector'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_jobs_short_description'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="jobsShortDesc">Job Short Description</label>
                                            <textarea class="form-control ckeditor" id="jobsShortDesc" placeholder="Short Description" name="jobsShortDesc"><?= set_value('jobsShortDesc', empty($job->short_desc) ? '' : $job->short_desc) ?></textarea>
                                            <?php echo form_error('jobsShortDesc'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_jobs_description'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="jobsDescription">Job Description</label>
                                            <textarea class="form-control ckeditor" id="jobsDescription" placeholder="Description" name="jobsDescription"><?= set_value('jobsDescription', empty($job->description) ? '' : $job->description) ?></textarea>
                                            <?php echo form_error('jobsDescription'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_jobs_status'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12 col-md-4">
                                            <label for="jobsStatus">Status<span class="text-danger">*</span></label>
                                            <select class="custom-select" id="jobsStatus" name="jobsStatus">
                                                <option value="">Select</option>
                                                <option value='1' <?= $job->active == 1 ? 'selected' : '' ?>>
                                                    Active
                                                </option>
                                                <option value='0' <?= $job->active != 1 ? 'selected' : '' ?>>
                                                    Inactive
                                                </option>
                                            </select>
                                            <?php echo form_error('jobsStatus'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_jobs_description_img'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="jobsDescImg">Cover Image <a href="javascript:void(0)" class="text-info" data-toggle="tooltip" data-placement="top" title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i class="fa fa-info-circle"></i></a></label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="jobsDescImg" id="jobsDescImg" accept=".png,.jpg,.jpeg">
                                                <label for="jobsDescImg" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <div id="jobsDescImgError" class="error-text"><?= $jobsDescImgError ?></div>
                                        </div>
                                        <?php if (!empty($job->desc_img)) : ?>
                                            <div class="col-sm-12">
                                                <div class="file-img-container">
                                                    <div class="file-img-container-option">
                                                        <a href="javascript:void(0)" class="file_edit_btn trigger_alert_modal" data-title="Confirm" data-desc="Are you sure want to delete this?" data-redirect="<?= base_url('panel/jobs/delete_cover_img/' . $job->id) ?>"><i class="fas fa-trash"></i> </a>
                                                    </div>
                                                    <img src="<?= base_url('assets/uploads/jobs/thumb_' . $job->desc_img) ?>" class="img-fluid" />
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="form-group col-sm-12">
                                            <label for="" class="text-danger"><i>* Image dimension should be 550 x 550px (Width x Height) and less than 500kb in size are recommended. Image types supported include jpg, jpeg and png. *</i></label>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($controller_config['disable_jobs_seo'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">SEO</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                            <i class="fas fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-sm-12">
                                                            <label for="jobsSeoTitle">Title </label>
                                                            <input type="text" class="form-control" id="jobsSeoTitle" placeholder="Title" name="jobsSeoTitle" value="<?= set_value('jobsSeoTitle', empty($job->seo_title) ? '' : $job->seo_title) ?>">
                                                            <?php echo form_error('jobsSeoTitle'); ?>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label for="jobsSeoMetaKeywords">Meta Keywords</label>
                                                            <textarea class="form-control" id="jobsSeoMetaKeywords" placeholder="Meta Keywords" name="jobsSeoMetaKeywords"><?= set_value('jobsSeoMetaKeywords', empty($job->seo_meta_keywords) ? '' : $job->seo_meta_keywords) ?></textarea>
                                                            <?php echo form_error('jobsSeoMetaKeywords'); ?>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label for="jobsSeoMetaDescription">Meta Description</label>
                                                            <textarea class="form-control" id="jobsSeoMetaDescription" placeholder="Meta Description" name="jobsSeoMetaDescription"><?= set_value('jobsSeoMetaDescription', empty($job->seo_meta_description) ? '' : $job->seo_meta_description) ?></textarea>
                                                            <?php echo form_error('jobsSeoMetaDescription'); ?>
                                                        </div>
                                                        <?php if ($controller_config['disable_jobs_canonical_url'] !== TRUE) : ?>
                                                            <div class="form-group col-sm-12">
                                                                <label for="jobsSeoCanonicalUrl">Canonical URL</label>
                                                                <textarea class="form-control" id="jobsSeoCanonicalUrl" placeholder="Canonical URL" name="jobsSeoCanonicalUrl"><?= set_value('jobsSeoCanonicalUrl', empty($job->seo_canonical_url) ? '' : $job->seo_canonical_url) ?></textarea>
                                                                <?php echo form_error('jobsSeoCanonicalUrl'); ?>
                                                            </div>
                                                        <?php endif; ?>

                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-sm-12 mt-4">
                                        <button type="submit" class="btn btn-success float-right">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div><!-- /.content-wrapper -->