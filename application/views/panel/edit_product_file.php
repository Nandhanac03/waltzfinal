<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Product File</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a
                                href="<?= site_url('panel/product/edit/' . $product->id) ?>">Product</a>
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
                        <form role="form" method="post"
                              action="<?= site_url('panel/product/edit_file/' . $product->id . '/' . $product_file->id . '/' . $current_language->id) ?>"
                              enctype="multipart/form-data" id="fileForm">
                            <div class="card-body">
                                <?php if ($languages && count($languages) > 1 && $controller_config['disable_pr_img_languages'] != TRUE): ?>
                                    <ul class="nav nav-tabs mb-4" id="news-content-below-tab" role="tablist">
                                        <?php
                                        $i = 1;
                                        foreach ($languages as $language):
                                            ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?= in_array($language->id, $file_desc_languages) && $language->id != $current_language->id ? ' bg-navy' : '' ?><?= $language->id == $current_language->id ? ' active bg-success' : '' ?>"
                                                   href="<?= base_url('panel/product/edit_file/' . $product->id . '/' . $product_file->id . '/' . $language->id) ?>"
                                                   role="tab" aria-selected="true"><?= $language->name ?></a>
                                            </li>
                                            <?php
                                        endforeach;
                                        ?>
                                    </ul>
                                <?php endif; ?>
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="fileTitle">Title</label>
                                        <input type="text"
                                               class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                               id="fileTitle" placeholder="Title" name="fileTitle"
                                               value="<?= set_value('fileTitle', empty($product_file_desc->title) ? '' : $product_file_desc->title) ?>">
                                               <?php echo form_error('fileTitle'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_pr_img_file_description'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="fileDescription">Description</label>
                                            <textarea class="form-control ckeditor"
                                                      id="fileDescription" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?>
                                                      placeholder="Description"
                                                      name="fileDescription"><?= set_value('fileDescription', empty($product_file_desc->description) ? '' : $product_file_desc->description) ?></textarea>
                                                      <?php echo form_error('fileDescription'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group col-sm-12">
                                        <label for="fileDescImg">Upload Image <a href="javascript:void(0)"
                                                                                 class="text-info" data-toggle="tooltip"
                                                                                 data-placement="top"
                                                                                 title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i
                                                    class="fa fa-info-circle"></i></a></label>
                                        <div class="tower-file">
                                            <input type="file" class="custom_fileInput" name="fileProduct"
                                                   id="fileProduct" accept=".png,.jpg,.jpeg">
                                            <label for="fileProduct" class="tower-file-button"> <span
                                                    class="mdi mdi-upload"></span>Browse </label>
                                            <button type="button" class="tower-file-clear tower-file-button">
                                                Clear
                                            </button>
                                        </div>
                                        <div id="fileProductError" class="error-text"><?= $fileProductError ?></div>
                                    </div>
                                    <?php if (!empty($product_file->file)): ?>
                                        <div class="col-sm-12">
                                            <div class="file-img-container">
                                                <img src="<?= base_url('assets/uploads/product/thumb_' . $product_file->file) ?>"
                                                     class="img-fluid"/>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_img_file_lg'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="fileProductLarge">Upload Image Large<a href="javascript:void(0)"
                                                                                               class="text-info"
                                                                                               data-toggle="tooltip"
                                                                                               data-placement="top"
                                                                                               title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>">
                                                    <i class="fa fa-info-circle"></i></a></label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="fileProductLarge"
                                                       id="fileProductLarge" accept=".png,.jpg,.jpeg">
                                                <label for="fileProductLarge" class="tower-file-button"> <span
                                                        class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <div id="fileProductLargeError" class="error-text"><?= $fileProductError ?></div>
                                        </div>
                                        <?php if (!empty($product_file->file_lg)): ?>
                                            <div class="col-sm-12">
                                                <div class="file-img-container">
                                                    <div class="file-img-container-option">
                                                        <a href="javascript:void(0)"
                                                           class="file_edit_btn trigger_alert_modal" data-title="Confirm"
                                                           data-desc="Are you sure want to delete this?"
                                                           data-redirect="<?= base_url('panel/product/delete_product_large_img/' . $product_file->product_id . '/' . $product_file->id) ?>"><i
                                                                class="fas fa-trash"></i> </a>
                                                    </div>
                                                    <img src="<?= base_url('assets/uploads/product/thumb_' . $product_file->file_lg) ?>"
                                                         class="img-fluid"/>
                                                </div>
                                            </div>
                                        <?php endif; ?>
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