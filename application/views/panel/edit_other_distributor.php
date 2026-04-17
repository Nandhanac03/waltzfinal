<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Other Distributor</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/other_distributor/all') ?>">Other Distributor</a></li>
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
                        <form role="form" method="post" action="<?= site_url('panel/other_distributor/edit/' . $id . '/' . $lang) ?>"
                              enctype="multipart/form-data" id="otherDistributorForm">
                            <div class="card-body">
                                <?php if ($languages && count($languages) > 1 && $controller_config['disable_other_distributor_languages'] != TRUE): ?>
                                    <ul class="nav nav-tabs mb-4" id="news-content-below-tab" role="tablist">
                                        <?php
                                        $i = 1;
                                        foreach ($languages as $language):
                                            ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?= in_array($language->id, $other_distributor_languages) && $language->id != $lang ? ' bg-navy' : '' ?><?= $language->id == $lang ? ' active bg-success' : '' ?>"
                                                   href="<?= base_url('panel/other_distributor/edit/' . $id . '/' . $language->id) ?>"
                                                   role="tab" aria-selected="true"><?= $language->name ?></a>
                                            </li>
                                            <?php
                                        endforeach;
                                        ?>
                                    </ul>
                                <?php endif; ?>
                                <div class="row">
                                    <?php if ($controller_config['disable_other_distributor_category'] !== TRUE): ?>
                                    <div class="form-group">
                                         <label for="otherDistributorCategory">Category <span class="text-danger">*</span></label>
                                         <select class="custom-select" id="otherDistributorCategory" name="otherDistributorCategory">
                                            <option value="">Select</option>
                                            <?php
                                            if ($distributor_categories):
                                                foreach ($distributor_categories as $distributor_category_key=>$distributor_category):
                                                    ?>
                                                    <option value="<?= $distributor_category_key?>" <?= $distributor_category_key == set_value('otherDistributorCategory',empty($otherDistributor->category) ? '' : $otherDistributor->category) ? 'selected' : '' ?>><?= $distributor_category ?></option>
                                                    <?php
                                                endforeach;
                                            endif;
                                            ?>
                                        </select>
                                        <?php echo form_error('otherDistributorCategory'); ?>
                                    </div>
                                    <?php endif; ?>
                                    <div class="form-group col-sm-12">
                                        <label for="otherDistributorTitle">Title <span class="text-danger">*</span></label>
                                        <input type="text"
                                               class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                               id="otherDistributorTitle" placeholder="Title" name="otherDistributorTitle"
                                               value="<?= set_value('otherDistributorTitle', empty($otherDistributor->title) ? '' : $otherDistributor->title) ?>">
                                               <?php echo form_error('otherDistributorTitle'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_other_distributor_description'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="otherDistributorDescription">Description</label>
                                            <textarea class="form-control ckeditor"
                                                      id="otherDistributorDescription" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?>
                                                      placeholder="Description"
                                                      name="otherDistributorDescription"><?= set_value('otherDistributorDescription', empty($otherDistributor->description) ? '' : $otherDistributor->description) ?></textarea>
                                                      <?php echo form_error('otherDistributorDescription'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_other_distributor_img'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="otherDistributorImg">Distributor Image <a href="javascript:void(0)" class="text-info"
                                                                                 data-toggle="tooltip" data-placement="top"
                                                                                 title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i
                                                        class="fa fa-info-circle"></i></a></label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="otherDistributorImg" id="otherDistributorImg"
                                                       accept=".png,.jpg,.jpeg">
                                                <label for="otherDistributorImg" class="tower-file-button"> <span
                                                        class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <div id="otherDistributorImgError" class="error-text"><?= $otherDistributorImgError ?></div>
                                        </div>
                                        <?php if (!empty($otherDistributor->distributor_img)): ?>
                                            <div class="col-sm-12">
                                                <div class="file-img-container">
                                                    <div class="file-img-container-option">
                                                        <a href="javascript:void(0)"
                                                           class="file_edit_btn trigger_alert_modal" data-title="Confirm"
                                                           data-desc="Are you sure want to delete this?"
                                                           data-redirect="<?= base_url('panel/other_distributor/delete_other_distributor_img/' . $otherDistributor->id . '/' . $otherDistributor->language) ?>"><i
                                                                class="fas fa-trash"></i> </a>
                                                    </div>
                                                    <img src="<?= base_url('assets/uploads/distributor/thumb_' . $otherDistributor->distributor_img) ?>"
                                                         class="img-fluid"/>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_other_distributor_link'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="otherDistributorLink">Link <span class="text-danger">*</span></label>
                                            <input type="text"
                                                   class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                   id="otherDistributorLink" placeholder="Link" name="otherDistributorLink"
                                                   value="<?= set_value('otherDistributorLink', empty($otherDistributor->link) ? '' : $otherDistributor->link) ?>">
                                                   <?php echo form_error('otherDistributorLink'); ?>
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