<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Service</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/article/all') ?>">Services</a></li>
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
                        <form role="form" method="post" action="<?= site_url('panel/article/add') ?>" enctype="multipart/form-data" id="articleForm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="articleTitle">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="articleTitle" placeholder="Title" name="articleTitle" value="<?= set_value('articleTitle') ?>" onchange="generate_slug_title(this, 'articleSlugTitle')">
                                        <?php echo form_error('articleTitle'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_article_slug_title'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="articleSlugTitle">Slug Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="articleSlugTitle" placeholder="Slug Title" name="articleSlugTitle" value="<?= set_value('articleSlugTitle') ?>">
                                            <?php echo form_error('articleSlugTitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_article_subtitle'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="articleSubtitle">Subtitle</label>
                                            <input type="text" class="form-control" id="articleTitle" placeholder="Subtitle" name="articleSubtitle" value="<?= set_value('articleSubtitle') ?>">
                                            <?php echo form_error('articleSubtitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_article_short_description'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="articleShortDesc">Short Description</label>
                                            <textarea class="form-control ckeditor" id="articleShortDesc" placeholder="Short Description" name="articleShortDesc"><?= set_value('articleShortDesc') ?></textarea>
                                            <?php echo form_error('articleShortDesc'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group col-sm-12">
                                        <label for="articleDescription">Description</label>
                                        <textarea class="form-control ckeditor" id="articleDescription" placeholder="Description" name="articleDescription"><?= set_value('articleDescription') ?></textarea>
                                        <?php echo form_error('articleDescription'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_article_description_img'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="articleDescImg">Description Image</label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="articleDescImg" id="articleDescImg" accept=".png,.jpg,.jpeg">
                                                <label for="articleDescImg" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <div id="articleBannerImgError" class="error-text"><?= $articleDescImgError ?></div>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label for="" class="text-danger fw-light"><i>*<?= $service_img_note ?>*</i></label>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_article_seo'] !== TRUE) : ?>
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
                                                            <label for="articleSeoTitle">Title </label>
                                                            <input type="text" class="form-control" id="articleSeoTitle" placeholder="Title" name="articleSeoTitle" value="<?= set_value('articleSeoTitle') ?>">
                                                            <?php echo form_error('articleSeoTitle'); ?>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label for="articleSeoMetaKeywords">Meta Keywords</label>
                                                            <textarea class="form-control" id="articleSeoMetaKeywords" placeholder="Meta Keywords" name="articleSeoMetaKeywords"><?= set_value('articleSeoMetaKeywords') ?></textarea>
                                                            <?php echo form_error('articleSeoMetaKeywords'); ?>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label for="articleSeoMetaDescription">Meta Description</label>
                                                            <textarea class="form-control" id="articleSeoMetaDescription" placeholder="Meta Description" name="articleSeoMetaDescription"><?= set_value('articleSeoMetaDescription') ?></textarea>
                                                            <?php echo form_error('articleSeoMetaDescription'); ?>
                                                        </div>
                                                        <?php if ($controller_config['disable_article_canonical_url'] !== TRUE) : ?>
                                                            <div class="form-group col-sm-12">
                                                                <label for="articleSeoCanonicalUrl">Canonical URL</label>
                                                                <textarea class="form-control" id="articleSeoCanonicalUrl" placeholder="Canonical URL" name="articleSeoCanonicalUrl"><?= set_value('articleSeoCanonicalUrl') ?></textarea>
                                                                <?php echo form_error('articleSeoCanonicalUrl'); ?>
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