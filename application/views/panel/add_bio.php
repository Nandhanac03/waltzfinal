<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Bio</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/bio/all') ?>">Bio</a></li>
                        <li class="breadcrumb-item active">Add</li>
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
                            <h3 class="card-title">Add</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="<?= site_url('panel/bio/add') ?>"
                            enctype="multipart/form-data" id="bioForm">
                            <div class="card-body">
                                <div class="row">
                                    <?php if ($controller_config['disable_bio_name'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="bioTitle">Name <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                id="bioName" placeholder="Name" name="bioName"
                                                value="<?= set_value('bioName') ?>">
                                            <?php echo form_error('bioName'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_bio_title'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="bioTitle">Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="bioTitle" placeholder="Title"
                                                name="bioTitle" value="<?= set_value('bioTitle') ?>"
                                                onchange="generate_slug_title(this, 'bioSlugTitle')">
                                            <?php echo form_error('bioTitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_bio_slugtitle'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="bioSlugTitle">Slug Title <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="bioSlugTitle"
                                                placeholder="Slug Title" name="bioSlugTitle"
                                                value="<?= set_value('bioSlugTitle') ?>">
                                            <?php echo form_error('bioSlugTitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_bio_subtitle'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="bioSubtitle">Subtitle</label>
                                            <input type="text" class="form-control" id="bioTitle" placeholder="Subtitle"
                                                name="bioSubtitle" value="<?= set_value('bioSubtitle') ?>">
                                            <?php echo form_error('bioSubtitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_bio_short_desc'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="bioShortDesc">Short Description</label>
                                            <textarea class="form-control ckeditor" id="bioShortDesc"
                                                placeholder="Short Description"
                                                name="bioShortDesc"><?= set_value('bioShortDesc') ?></textarea>
                                            <?php echo form_error('bioShortDesc'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_bio_description'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="bioDescription">Description</label>
                                            <textarea class="form-control ckeditor" id="bioDescription"
                                                placeholder="Description"
                                                name="bioDescription"><?= set_value('bioDescription') ?></textarea>
                                            <?php echo form_error('bioDescription'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_bio_person_is'] != TRUE): ?>
                                        <div class="form-group col-sm-4">
                                            <label for="bioPersonIs">Type</label>
                                            <select class="custom-select" id="bioPersonIs" name="bioPersonIs">
                                                <option value="">Select</option>
                                                <option value="A" <?= 'A' == set_value('bioPersonIs') ? 'selected' : '' ?>>Author</option>
                                                <option value="I" <?= 'I' == set_value('bioPersonIs') ? 'selected' : '' ?>>Illustrator</option>
                                            </select>
                                            <?php echo form_error('bioPersonIs'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($controller_config['disable_bio_description_img'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="bioDescImg">Description Image <a href="javascript:void(0)"
                                                    class="text-info"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i
                                                        class="fa fa-info-circle"></i></a></label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="bioDescImg"
                                                    id="bioDescImg" accept=".png,.jpg,.jpeg">
                                                <label for="bioDescImg" class="tower-file-button"> <span
                                                        class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <div id="bioBannerImgError"
                                                class="error-text"><?= $bioDescImgError ?></div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($controller_config['disable_bio_additional_description_img'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="additional_img">Additional Image <a href="javascript:void(0)"
                                                    class="text-info"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i
                                                        class="fa fa-info-circle"></i></a></label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="additional_img"
                                                    id="additional_img" accept=".png,.jpg,.jpeg">
                                                <label for="additional_img" class="tower-file-button"> <span
                                                        class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <div id="bioBannerImgError"
                                                class="error-text"><?= $additional_imgError ?></div>
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