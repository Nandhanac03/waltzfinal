<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Page</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/page/all') ?>">Page</a></li>
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
                        <form role="form" method="post" action="<?= site_url('panel/page/add') ?>"
                            enctype="multipart/form-data" id="pageForm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12 col-md-4">
                                        <label for="pageMenu">Menu<span class="text-danger">*</span></label>
                                        <select class="custom-select" id="pageMenu" name="pageMenu">
                                            <?php
                                            if ($menus):
                                                foreach ($menus as $menu_item):
                                            ?>
                                                    <option value="<?= $menu_item->id ?>" <?= $_POST['pageMenu'] == $menu_item->id ? 'selected' : '' ?>><?= $menu_item->title ?></option>
                                            <?php
                                                endforeach;
                                            endif;
                                            ?>
                                        </select>
                                        <?php echo form_error('pageMenu'); ?>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="pageTitle">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="pageTitle" placeholder="Title"
                                            name="pageTitle" value="<?= set_value('pageTitle') ?>"
                                            onchange="generate_slug_title(this, 'pageSlugTitle')">
                                        <?php echo form_error('pageTitle'); ?>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="pageSlugTitle">Slug Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="pageSlugTitle"
                                            placeholder="Slug Title" name="pageSlugTitle"
                                            value="<?= set_value('pageSlugTitle') ?>">
                                        <?php echo form_error('pageSlugTitle'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_page_subtitle'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="pageSubtitle">Subtitle</label>
                                            <input type="text" class="form-control" id="pageTitle" placeholder="Subtitle"
                                                name="pageSubtitle" value="<?= set_value('pageSubtitle') ?>">
                                            <?php echo form_error('pageSubtitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_page_short_desc'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="pageShortDesc">Short Description</label>
                                            <textarea class="form-control ckeditor" id="pageShortDesc"
                                                placeholder="Short Description"
                                                name="pageShortDesc"><?= set_value('pageShortDesc') ?></textarea>
                                            <?php echo form_error('pageShortDesc'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_page_description'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="pageDescription">Description</label>
                                            <textarea class="form-control ckeditor" id="pageDescription"
                                                placeholder="Description"
                                                name="pageDescription"><?= set_value('pageDescription') ?></textarea>
                                            <?php echo form_error('pageDescription'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="form-group col-sm-12">
                                        <label for="pageDescImg">Description Image <a href="javascript:void(0)"
                                                class="text-info"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i
                                                    class="fa fa-info-circle"></i></a></label>
                                        <div class="tower-file">
                                            <input type="file" class="custom_fileInput" name="pageDescImg"
                                                id="pageDescImg" accept=".png,.jpg,.jpeg">
                                            <label for="pageDescImg" class="tower-file-button"> <span
                                                    class="mdi mdi-upload"></span>Browse </label>
                                            <button type="button" class="tower-file-clear tower-file-button">
                                                Clear
                                            </button>
                                        </div>
                                        <div id="pageDescImgError" class="error-text"><?= $pageDescImgError ?></div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="pageDescBrandImg">Brand Image <a href="javascript:void(0)"
                                                class="text-info"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i
                                                    class="fa fa-info-circle"></i></a></label>
                                        <div class="tower-file">
                                            <input type="file" class="custom_fileInput" name="pageDescBrandImg"
                                                id="pageDescBrandImg" accept=".png,.jpg,.jpeg">
                                            <label for="pageDescBrandImg" class="tower-file-button"> <span
                                                    class="mdi mdi-upload"></span>Browse </label>
                                            <button type="button" class="tower-file-clear tower-file-button">
                                                Clear
                                            </button>
                                        </div>
                                        <div id="pageDescBrandImg" class="error-text"><?= $pageDescBrandImgError ?></div>
                                    </div>


                                    <?php if ($controller_config['disable_pr_document'] !== TRUE) : 
                                            ?>
                                    <div class="form-group col-sm-12">
                                        <label for="pageDocumentFile">Documents <a href="javascript:void(0)" class="text-info" data-toggle="tooltip" data-placement="top" title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i class="fa fa-info-circle"></i></a></label>
                                        <div class="tower-file">
                                            <input type="file" class="custom_fileInput" name="pageDocumentFile[]" id="pageDocumentFile" accept=".pdf" multiple>
                                            <label for="pageDocumentFile" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse </label>
                                            <button type="button" class="tower-file-clear tower-file-button">
                                                Clear
                                            </button>
                                        </div>
                                        <div id="pageDocumentError" class="error-text"><?= $pageDocumentError ?></div>
                                    </div>
                                    <?php endif; 
                                    ?>


                                    <?php if ($controller_config['disable_page_seo'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">SEO</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="collapse" data-toggle="tooltip"
                                                            title="Collapse">
                                                            <i class="fas fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-sm-12">
                                                            <label for="pageSeoTitle">Title </label>
                                                            <input type="text" class="form-control" id="pageSeoTitle"
                                                                placeholder="Title" name="pageSeoTitle"
                                                                value="<?= set_value('pageSeoTitle') ?>">
                                                            <?php echo form_error('pageSeoTitle'); ?>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label for="pageSeoMetaKeywords">Meta Keywords</label>
                                                            <textarea class="form-control" id="pageSeoMetaKeywords"
                                                                placeholder="Meta Keywords"
                                                                name="pageSeoMetaKeywords"><?= set_value('pageSeoMetaKeywords') ?></textarea>
                                                            <?php echo form_error('pageSeoMetaKeywords'); ?>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label for="pageSeoMetaDescription">Meta Description</label>
                                                            <textarea class="form-control" id="pageSeoMetaDescription"
                                                                placeholder="Meta Description"
                                                                name="pageSeoMetaDescription"><?= set_value('pageSeoMetaDescription') ?></textarea>
                                                            <?php echo form_error('pageSeoMetaDescription'); ?>
                                                        </div>
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