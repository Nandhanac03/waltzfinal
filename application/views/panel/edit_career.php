<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">What We Do</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/career/all') ?>">What We Do</a></li>
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
                        <form role="form" method="post" action="<?= site_url('panel/career/edit/' . $id . '/' . $lang) ?>"
                              enctype="multipart/form-data" id="careerForm">
                            <div class="card-body">
                                <?php if ($languages && count($languages) > 1 && $controller_config['disable_career_languages'] != TRUE): ?>
                                    <ul class="nav nav-tabs mb-4" id="news-content-below-tab" role="tablist">
                                        <?php
                                        $i = 1;
                                        foreach ($languages as $language):
                                            ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?= in_array($language->id, $career_languages) && $language->id != $lang ? ' bg-navy' : '' ?><?= $language->id == $lang ? ' active bg-success' : '' ?>"
                                                   href="<?= base_url('panel/career/edit/' . $id . '/' . $language->id) ?>"
                                                   role="tab" aria-selected="true"><?= $language->name ?></a>
                                            </li>
                                            <?php
                                        endforeach;
                                        ?>
                                    </ul>
                                <?php endif; ?>
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="careerTitle">Title <span class="text-danger">*</span></label>
                                        <input type="text"
                                               class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                               id="careerTitle" placeholder="Title" name="careerTitle"
                                               value="<?= set_value('careerTitle', empty($career->title) ? '' : $career->title) ?>">
                                               <?php echo form_error('careerTitle'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_career_short_desc'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="careerShortDesc">Short Description</label>
                                            <textarea class="form-control ckeditor"
                                                      id="careerShortDesc" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?>
                                                      placeholder="Short Description"
                                                      name="careerShortDesc"><?= set_value('careerShortDesc', empty($career->short_desc) ? '' : $career->short_desc) ?></textarea>
                                                      <?php echo form_error('careerShortDesc'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group col-sm-12">
                                        <label for="careerDescription">Description</label>
                                        <textarea class="form-control ckeditor"
                                                  id="careerDescription" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?>
                                                  placeholder="Description"
                                                  name="careerDescription"><?= set_value('careerDescription', empty($career->description) ? '' : $career->description) ?></textarea>
                                                  <?php echo form_error('careerDescription'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_career_description_img'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="careerDescImg">Description Image <a href="javascript:void(0)"
                                                                                            class="text-info"
                                                                                            data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i
                                                        class="fa fa-info-circle"></i></a></label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="careerDescImg"
                                                       id="careerDescImg" accept=".png,.jpg,.jpeg">
                                                <label for="careerDescImg" class="tower-file-button"> <span
                                                        class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>														
                                            <div id="careerDescImgError"
                                                 class="error-text"><?= $careerDescImgError ?></div>
                                        </div>
                                        <?php if (!empty($career->desc_img)): ?>
                                            <div class="col-sm-12">
                                                <div class="file-img-container">
                                                    <div class="file-img-container-option">
                                                        <a href="javascript:void(0)"
                                                           class="file_edit_btn trigger_alert_modal"
                                                           data-title="Confirm"
                                                           data-desc="Are you sure want to delete this?"
                                                           data-redirect="<?= base_url('panel/career/delete_desc_img/' . $career->id . '/' . $career->language) ?>"><i
                                                                class="fas fa-trash"></i> </a>
                                                    </div>
                                                    <img src="<?= base_url('assets/uploads/career/thumb_' . $career->desc_img) ?>"
                                                         class="img-fluid"/>
                                                </div>
                                            </div>
                                        <?php endif; ?><?php endif; ?>
                                    <div class="col-sm-12 mt-4">
                                        <button type="submit" class="btn btn-success float-right">Save</button>
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