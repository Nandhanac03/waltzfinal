<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Testimonial</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/testimonial/all') ?>">Testimonials</a>
                        </li>
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
                        <form role="form" method="post" action="<?= site_url('panel/testimonial/edit/' . $id . '/' . $lang) ?>" enctype="multipart/form-data" id="testimonialForm">
                            <div class="card-body">
                                <?php if ($languages && count($languages) > 1 && $controller_config['disable_testimonial_languages'] != TRUE) : ?>
                                    <ul class="nav nav-tabs mb-4" id="news-content-below-tab" role="tablist">
                                        <?php
                                        $i = 1;
                                        foreach ($languages as $language) :
                                        ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?= in_array($language->id, $testimonial_languages) && $language->id != $lang ? ' bg-navy' : '' ?><?= $language->id == $lang ? ' active bg-success' : '' ?>" href="<?= base_url('panel/testimonial/edit/' . $id . '/' . $language->id) ?>" role="tab" aria-selected="true"><?= $language->name ?></a>
                                            </li>
                                        <?php
                                        endforeach;
                                        ?>
                                    </ul>
                                <?php endif; ?>
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="testimonialStatement">Statement <span class="text-danger">*</span></label>
                                        <textarea class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="testimonialStatement" placeholder="Statement" name="testimonialStatement"><?= set_value('testimonialTitle', empty($testimonial->statement) ? '' : $testimonial->statement) ?></textarea>
                                        <?php echo form_error('testimonialStatement'); ?>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="testimonialSlugTitle">Statement By <span class="text-danger">*</span></label>
                                        <textarea class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="testimonialStatementBy" placeholder="Statement By" name="testimonialStatementBy"><?= set_value('testimonialStatementBy', empty($testimonial->statement_by) ? '' : $testimonial->statement_by) ?></textarea>
                                        <?php echo form_error('testimonialStatementBy'); ?>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="testimonialDesignation">Designation</label>
                                        <input type="text" class="form-control" id="testimonialDesignation" placeholder="Designation" name="testimonialDesignation" value="<?= set_value('testimonialStatementBy', empty($testimonial->designation) ? '' : $testimonial->designation) ?>">
                                        <?php echo form_error('testimonialDesignation'); ?>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="testimonialAuthorImg">Author Image</label>
                                        <div class="tower-file">
                                            <input type="file" class="custom_fileInput" name="testimonialAuthorImg" id="testimonialAuthorImg" accept=".png,.jpg,.jpeg">
                                            <label for="testimonialAuthorImg" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse </label>
                                            <button type="button" class="tower-file-clear tower-file-button">
                                                Clear
                                            </button>
                                        </div>
                                        <div id="testimonialAuthorImgError" class="error-text"><?= $testimonialAuthorImgError ?></div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                            <label for="" class="text-danger fw-light"><i>*<?= $author_img_note ?>*</i></label>
                                        </div>
                                    <?php if (!empty($testimonial->desc_img)) : ?>
                                        <div class="col-sm-12">
                                            <div class="file-img-container">
                                                <div class="file-img-container-option">
                                                    <a href="javascript:void(0)" class="file_edit_btn trigger_alert_modal" data-title="Confirm" data-desc="Are you sure want to delete this?" data-redirect="<?= base_url('panel/testimonial/delete_desc_img/' . $testimonial->id . '/' . $testimonial->language) ?>"><i class="fas fa-trash"></i> </a>
                                                </div>
                                                <img src="<?= base_url('assets/uploads/testimonials/thumb_' . $testimonial->desc_img) ?>" class="img-fluid" />
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