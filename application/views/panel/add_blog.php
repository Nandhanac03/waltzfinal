<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Projects</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/blog/all') ?>">Projects</a></li>
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
                        <form role="form" method="post" action="<?= site_url('panel/blog/add') ?>" enctype="multipart/form-data" id="blogForm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="blogTitle">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="blogTitle" placeholder="Title" name="blogTitle" value="<?= set_value('blogTitle') ?>" onchange="generate_slug_title(this, 'blogSlugTitle')">
                                        <?php echo form_error('blogTitle'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_blog_slug_title'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="blogSlugTitle">Slug Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="blogSlugTitle" placeholder="Slug Title" name="blogSlugTitle" value="<?= set_value('blogSlugTitle') ?>">
                                            <?php echo form_error('blogSlugTitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_blog_subtitle'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="blogSubtitle">Category</label>
                                            <input type="text" class="form-control" id="blogSubTitle" placeholder="Category" name="blogSubtitle" value="<?= set_value('blogSubtitle') ?>">
                                            <?php echo form_error('blogSubtitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_blog_area'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="articleSubtitle">Client</label>
                                            <input type="text" class="form-control" id="blogArea" placeholder="eg. sports,politics" name="blogArea" value="<?= set_value('blogArea') ?>">
                                            <?php echo form_error('articleSubtitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_blog_date'] != TRUE) : ?>
                                    <div class="form-group col-2">
                                        <label for="project_date">Project Date</label><br>
                                        <input class="form-control" type="date" id="project_date" name="project_date">
                                    </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($controller_config['disable_blog_short_description'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="blogShortDesc">Short Description</label>
                                            <textarea class="form-control ckeditor" id="blogShortDesc" placeholder="Short Description" name="blogShortDesc"><?= set_value('blogShortDesc') ?></textarea>
                                            <?php echo form_error('blogShortDesc'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_blog_description'] != TRUE) : ?>

                                    <div class="form-group col-sm-12">
                                        <label for="blogDescription">Description</label>
                                        <textarea class="form-control ckeditor" id="blogDescription" placeholder="Description" name="blogDescription"><?= set_value('blogDescription') ?></textarea>
                                        <?php echo form_error('blogDescription'); ?>
                                    </div>
                                    <?php endif; ?>

                                    <?php if ($controller_config['disable_blog_description_img'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="blogDescImg">Description Image</label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="blogDescImg" id="blogDescImg" accept=".png,.jpg,.jpeg">
                                                <label for="blogDescImg" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <div id="blogBannerImgError" class="error-text"><?= $blogDescImgError ?></div>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label for="" class="text-danger fw-light"><i>*<?= $cover_img_note ?>*</i></label>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_blog_brand_img'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="blogBrandImg">Author Image</label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="blogBrandImg" id="blogBrandImg" accept=".png,.jpg,.jpeg">
                                                <label for="blogBrandImg" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <div id="blogBrandImgError" class="error-text"><?= $blogBrandImgError ?></div>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label for="" class="text-danger fw-light"><i>*<?= $author_img_note ?>*</i></label>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_blog_seo'] !== TRUE) : ?>
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
                                                            <label for="blogSeoTitle">Title </label>
                                                            <input type="text" class="form-control" id="blogSeoTitle" placeholder="Title" name="blogSeoTitle" value="<?= set_value('blogSeoTitle') ?>">
                                                            <?php echo form_error('blogSeoTitle'); ?>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label for="blogSeoMetaKeywords">Meta Keywords</label>
                                                            <textarea class="form-control" id="blogSeoMetaKeywords" placeholder="Meta Keywords" name="blogSeoMetaKeywords"><?= set_value('blogSeoMetaKeywords') ?></textarea>
                                                            <?php echo form_error('blogSeoMetaKeywords'); ?>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label for="blogSeoMetaDescription">Meta Description</label>
                                                            <textarea class="form-control" id="blogSeoMetaDescription" placeholder="Meta Description" name="blogSeoMetaDescription"><?= set_value('blogSeoMetaDescription') ?></textarea>
                                                            <?php echo form_error('blogSeoMetaDescription'); ?>
                                                        </div>
                                                        <?php if ($controller_config['disable_blog_canonical_url'] !== TRUE) : ?>
                                                            <div class="form-group col-sm-12">
                                                                <label for="blogSeoCanonicalUrl">Canonical URL</label>
                                                                <textarea class="form-control" id="blogSeoCanonicalUrl" placeholder="Canonical URL" name="blogSeoCanonicalUrl"><?= set_value('blogSeoCanonicalUrl') ?></textarea>
                                                                <?php echo form_error('blogSeoCanonicalUrl'); ?>
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