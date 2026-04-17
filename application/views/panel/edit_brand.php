<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Process</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/brand/all') ?>">Process</a></li>
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
                        <form role="form" method="post" action="<?= site_url('panel/brand/edit/' . $id . '/' . $lang) ?>"
                              enctype="multipart/form-data" id="brandForm">
                            <div class="card-body">
                                <?php if ($languages && count($languages) > 1 && $controller_config['disable_brand_languages'] != TRUE): ?>
                                    <ul class="nav nav-tabs mb-4" id="news-content-below-tab" role="tablist">
                                        <?php
                                        $i = 1;
                                        foreach ($languages as $language):
                                            ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?= in_array($language->id, $brand_languages) && $language->id != $lang ? ' bg-navy' : '' ?><?= $language->id == $lang ? ' active bg-success' : '' ?>"
                                                   href="<?= base_url('panel/brand/edit/' . $id . '/' . $language->id) ?>"
                                                   role="tab" aria-selected="true"><?= $language->name ?></a>
                                            </li>
                                            <?php
                                        endforeach;
                                        ?>
                                    </ul>
                                <?php endif; ?>
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="brandName">Name <span class="text-danger">*</span></label>
                                        <input type="text"
                                               class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                               id="brandName" placeholder="Name" name="brandName"
                                               value="<?= set_value('brandName', empty($brand->brand_name) ? '' : $brand->brand_name) ?>">
                                               <?php echo form_error('brandName'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_brand_description'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="brandDescription">Description</label>
                                            <textarea class="form-control ckeditor"
                                                      id="brandDescription" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?>
                                                      placeholder="Description"
                                                      name="brandDescription"><?= set_value('brandDescription', empty($brand->description) ? '' : $brand->description) ?></textarea>
                                                      <?php echo form_error('brandDescription'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_brand_img'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="brandImg">Brand Image <a href="javascript:void(0)" class="text-info"
                                                                                 data-toggle="tooltip" data-placement="top"
                                                                                 title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i
                                                        class="fa fa-info-circle"></i></a></label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="brandImg" id="brandImg"
                                                       accept=".png,.jpg,.jpeg">
                                                <label for="brandImg" class="tower-file-button"> <span
                                                        class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <div id="brandImgError" class="error-text"><?= $brandImgError ?></div>
                                        </div>
                                        <?php if (!empty($brand->brand_img)): ?>
                                            <div class="col-sm-12">
                                                <div class="file-img-container">
                                                    <div class="file-img-container-option">
                                                        <a href="javascript:void(0)"
                                                           class="file_edit_btn trigger_alert_modal" data-title="Confirm"
                                                           data-desc="Are you sure want to delete this?"
                                                           data-redirect="<?= base_url('panel/brand/delete_brand_img/' . $brand->id . '/' . $brand->language) ?>"><i
                                                                class="fas fa-trash"></i> </a>
                                                    </div>
                                                    <img src="<?= base_url('assets/uploads/brand/thumb_' . $brand->brand_img) ?>"
                                                         class="img-fluid"/>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_brand_link'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="brandLink">Link <span class="text-danger">*</span></label>
                                            <input type="text"
                                                   class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                   id="brandLink" placeholder="Link" name="brandLink"
                                                   value="<?= set_value('brandLink', empty($brand->link) ? '' : $brand->link) ?>">
                                                   <?php echo form_error('brandLink'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group col-sm-12">
                                        <label for="brandStatus">Status <span class="text-danger">*</span></label>
                                        <select name="brandStatus" id="brandStatus" class="form-control">
                                            <option value="2" selected>Inactive</option>
                                            <option value="1" <?=set_value('brandStatus')==$brand->active || $brand->active==1?'selected':''?>>Active</option>
                                        </select>
                                    </div>
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