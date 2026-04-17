<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Partner</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/partner/all') ?>">Partner</a></li>
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
                        <form role="form" method="post" action="<?= site_url('panel/partner/edit/' . $id . '/' . $lang) ?>"
                              enctype="multipart/form-data" id="partnerForm">
                            <div class="card-body">
                                <?php if ($languages && count($languages) > 1 && $controller_config['disable_partner_languages'] != TRUE): ?>
                                    <ul class="nav nav-tabs mb-4" id="news-content-below-tab" role="tablist">
                                        <?php
                                        $i = 1;
                                        foreach ($languages as $language):
                                            ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?= in_array($language->id, $partner_languages) && $language->id != $lang ? ' bg-navy' : '' ?><?= $language->id == $lang ? ' active bg-success' : '' ?>"
                                                   href="<?= base_url('panel/partner/edit/' . $id . '/' . $language->id) ?>"
                                                   role="tab" aria-selected="true"><?= $language->name ?></a>
                                            </li>
                                            <?php
                                        endforeach;
                                        ?>
                                    </ul>
                                <?php endif; ?>
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="partnerName">Name <span class="text-danger">*</span></label>
                                        <input type="text"
                                               class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                               id="partnerName" placeholder="Name" name="partnerName"
                                               value="<?= set_value('partnerName', empty($partner->partner_name) ? '' : $partner->partner_name) ?>">
                                               <?php echo form_error('partnerName'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_partner_description'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="partnerDescription">Description</label>
                                            <textarea class="form-control ckeditor"
                                                      id="partnerDescription" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?>
                                                      placeholder="Description"
                                                      name="partnerDescription"><?= set_value('partnerDescription', empty($partner->description) ? '' : $partner->description) ?></textarea>
                                                      <?php echo form_error('partnerDescription'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_partner_img'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="partnerImg">Partner Image <a href="javascript:void(0)" class="text-info"
                                                                                     data-toggle="tooltip" data-placement="top"
                                                                                     title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i
                                                        class="fa fa-info-circle"></i></a></label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="partnerImg" id="partnerImg"
                                                       accept=".png,.jpg,.jpeg">
                                                <label for="partnerImg" class="tower-file-button"> <span
                                                        class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <div id="partnerImgError" class="error-text"><?= $partnerImgError ?></div>
                                        </div>
                                        <?php if (!empty($partner->partner_img)): ?>
                                            <div class="col-sm-12">
                                                <div class="file-img-container">
                                                    <div class="file-img-container-option">
                                                        <?php if ($controller_config['disable_partner_img_delete'] !== TRUE): ?>
                                                        <a href="javascript:void(0)"
                                                           class="file_edit_btn trigger_alert_modal" data-title="Confirm"
                                                           data-desc="Are you sure want to delete this?"
                                                           data-redirect="<?= base_url('panel/partner/delete_partner_img/' . $partner->id . '/' . $partner->language) ?>"><i
                                                                class="fas fa-trash"></i> </a>
                                                        <?php endif; ?>
                                                    </div>
                                                    <img src="<?= base_url('assets/uploads/partner/thumb_' . $partner->partner_img) ?>"
                                                         class="img-fluid"/>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_partner_link'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="partnerLink">Link <span class="text-danger">*</span></label>
                                            <input type="text"
                                                   class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                   id="partnerLink" placeholder="Link" name="partnerLink"
                                                   value="<?= set_value('partnerLink', empty($partner->link) ? '' : $partner->link) ?>">
                                                   <?php echo form_error('partnerLink'); ?>
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