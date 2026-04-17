<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Services</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/bio/all') ?>">Services</a></li>
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
                        <form role="form" method="post" action="<?= site_url('panel/bio/edit/' . $id . '/' . $lang) ?>"
                            enctype="multipart/form-data" id="bioForm">
                            <div class="card-body">
                                <?php if ($languages && count($languages) > 1 && $controller_config['disable_bio_languages'] != TRUE): ?>
                                    <ul class="nav nav-tabs mb-4" id="news-content-below-tab" role="tablist">
                                        <?php
                                        $i = 1;
                                        foreach ($languages as $language):
                                        ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?= in_array($language->id, $bio_languages) && $language->id != $lang ? ' bg-navy' : '' ?><?= $language->id == $lang ? ' active bg-success' : '' ?>"
                                                    href="<?= base_url('panel/bio/edit/' . $id . '/' . $language->id) ?>"
                                                    role="tab" aria-selected="true"><?= $language->name ?></a>
                                            </li>
                                        <?php
                                        endforeach;
                                        ?>
                                    </ul>
                                <?php endif; ?>
                                <div class="row">
                                    <?php if ($controller_config['disable_bio_name'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="bioTitle">Name <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                id="bioName" placeholder="Name" name="bioName"
                                                value="<?= set_value('bioName', empty($bio->name) ? '' : $bio->name) ?>">
                                            <?php echo form_error('bioName'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_bio_title'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="bioTitle">Title <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                id="bioTitle" placeholder="Title" name="bioTitle"
                                                value="<?= set_value('bioTitle', empty($bio->name) ? '' : $bio->name) ?>"
                                                onchange="generate_slug_title(this, 'bioSlugTitle')">
                                            <?php echo form_error('bioTitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_bio_slugtitle'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="bioSlugTitle">Slug Title <span
                                                    class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                id="bioSlugTitle" placeholder="Slug Title" name="bioSlugTitle"
                                                value="<?= set_value('bioSlugTitle', empty($bio->title_slug) ? '' : $bio->title_slug) ?>">
                                            <?php echo form_error('bioSlugTitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_bio_subtitle'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="bioSubtitle">Subtitle</label>
                                            <input type="text"
                                                class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                id="bioTitle" placeholder="Subtitle" name="bioSubtitle"
                                                value="<?= set_value('bioSubtitle', empty($bio->subtitle) ? '' : $bio->subtitle) ?>">
                                            <?php echo form_error('bioSubtitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_bio_short_desc'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="bioShortDesc">Short Description</label>
                                            <textarea class="form-control ckeditor"
                                                id="bioShortDesc" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?>
                                                placeholder="Short Description"
                                                name="bioShortDesc"><?= set_value('bioShortDesc', empty($bio->short_desc) ? '' : $bio->short_desc) ?></textarea>
                                            <?php echo form_error('bioShortDesc'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_bio_description'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="bioDescription">Description</label>
                                            <textarea class="form-control ckeditor"
                                                id="bioDescription" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?>
                                                placeholder="Description"
                                                name="bioDescription"><?= set_value('bioDescription', empty($bio->description) ? '' : $bio->description) ?></textarea>
                                            <?php echo form_error('bioDescription'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_bio_person_is'] != TRUE): ?>
                                        <div class="form-group col-sm-4">
                                            <label for="bioPersonIs">Type</label>
                                            <select class="custom-select" id="bioPersonIs" name="bioPersonIs">
                                                <option value="">Select</option>
                                                <option value="A" <?= 'A' == set_value('bioPersonIs', empty($bio->person_is) ? '' : $bio->person_is) ? 'selected' : '' ?>>Author</option>
                                                <option value="I" <?= 'I' == set_value('bioPersonIs', empty($bio->person_is) ? '' : $bio->person_is) ? 'selected' : '' ?>>Illustrator</option>
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
                                            <div id="bioDescImgError" class="error-text"><?= $bioDescImgError ?></div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($bio->desc_img)): ?>
                                        <div class="col-sm-12">
                                            <div class="file-img-container">
                                                <div class="file-img-container-option">
                                                    <a href="javascript:void(0)"
                                                        class="file_edit_btn trigger_alert_modal" data-title="Confirm"
                                                        data-desc="Are you sure want to delete this?"
                                                        data-redirect="<?= base_url('panel/bio/delete_desc_img/' . $bio->id . '/' . $bio->language) ?>"><i
                                                            class="fas fa-trash"></i> </a>
                                                </div>
                                                <img src="<?= base_url('assets/uploads/bio/thumb_' . $bio->desc_img) ?>"
                                                    class="img-fluid" />
                                            </div>
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
                                            <div id="additional_imgError" class="error-text"><?= $additional_imgError ?></div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($bio->additional_img)): ?>
                                        <div class="col-sm-12">
                                            <div class="file-img-container">
                                                <div class="file-img-container-option">
                                                    <a href="javascript:void(0)"
                                                        class="file_edit_btn trigger_alert_modal" data-title="Confirm"
                                                        data-desc="Are you sure want to delete this?"
                                                        data-redirect="<?= base_url('panel/bio/delete_adddesc_img/' . $bio->id . '/' . $bio->language) ?>"><i
                                                            class="fas fa-trash"></i> </a>
                                                </div>
                                                <img src="<?= base_url('assets/uploads/bio/thumb_' . $bio->additional_img) ?>"
                                                    class="img-fluid" />
                                            </div>
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