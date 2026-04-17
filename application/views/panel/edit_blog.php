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
                        <form role="form" method="post" action="<?= site_url('panel/blog/edit/') . $blog->id ?>" enctype="multipart/form-data" id="blogForm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="blogTitle">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="blogTitle" placeholder="Title" name="blogTitle" value="<?= set_value('blogTitle', empty($blog->title) ? '' : $blog->title) ?>" onchange="generate_slug_title(this, 'blogSlugTitle')">
                                        <?php echo form_error('blogTitle'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_blog_slug_title'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="blogSlugTitle">Slug Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="blogSlugTitle" placeholder="Slug Title" name="blogSlugTitle" value="<?= set_value('blogSlugTitle', empty($blog->title_slug) ? '' : $blog->title_slug) ?>">
                                            <?php echo form_error('blogSlugTitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_blog_subtitle'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="blogSubtitle">Category</label>
                                            <input type="text" class="form-control" id="blogTitle" placeholder="Category" name="blogSubtitle" value="<?= set_value('blogSubtitle', empty($blog->subtitle) ? '' : $blog->subtitle) ?>">
                                            <?php echo form_error('blogSubtitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_blog_area'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="articleSubtitle">Client</label>
                                            <input type="text" class="form-control" id="blogArea" placeholder="eg. sports,politics" name="blogArea" value="<?= set_value('blogSubtitle', empty($blog->additional_info) ? '' : $blog->additional_info) ?>">
                                            <?php echo form_error('articleSubtitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_blog_date'] != TRUE) : ?>

                                    <div class="form-group col-2">
                                        <label for="project_date">Project Date</label><br>
                                        <input class="form-control" type="date" id="project_date" name="project_date" value="<?= empty($blog->project_date) ? '' : $blog->project_date ?>">
                                    </div>
                                    <?php endif; ?>

                                    <?php if ($controller_config['disable_blog_short_description'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="blogShortDesc">Short Description</label>
                                            <textarea class="form-control ckeditor" id="blogShortDesc" placeholder="Short Description" name="blogShortDesc"><?= set_value('blogShortDesc', empty($blog->short_desc) ? '' : $blog->short_desc) ?></textarea>
                                            <?php echo form_error('blogShortDesc'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_blog_description'] != TRUE) : ?>

                                    <div class="form-group col-sm-12">
                                        <label for="blogDescription">Description</label>
                                        <textarea class="form-control ckeditor" id="blogDescription" placeholder="Description" name="blogDescription"><?= set_value('blogDescription', empty($blog->description) ? '' : $blog->description) ?></textarea>
                                        <?php echo form_error('blogDescription'); ?>
                                    </div>
                                    <?php endif; ?>

                                    
                                    <div class="form-group col-sm-12">
                                        <label for="blogDescImg">Cover Image</label>
                                        <div class="tower-file">
                                            <input type="file" class="custom_fileInput" name="blogDescImg" id="blogDescImg" accept=".png,.jpg,.jpeg">
                                            <label for="blogDescImg" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse </label>
                                            <button type="button" class="tower-file-clear tower-file-button">
                                                Clear
                                            </button>
                                        </div>
                                        <div id="blogDescImgError" class="error-text"><?= $blogDescImgError ?></div>
                                    </div>
                                    <?php if (!empty($blog->desc_img)) : ?>
                                        <div class="col-sm-12">
                                            <div class="file-img-container">
                                                <div class="file-img-container-option">
                                                    <a href="javascript:void(0)" class="file_edit_btn trigger_alert_modal" data-title="Confirm" data-desc="Are you sure want to delete this?" data-redirect="<?= base_url('panel/blog/delete_cover_img/' . $blog->id . '/' . $blog->language) ?>"><i class="fas fa-trash"></i> </a>
                                                </div>
                                                <img src="<?= base_url('assets/uploads/blog/thumb_' . $blog->desc_img) ?>" class="img-fluid" />
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group col-sm-12">
                                        <label for="" class="text-danger fw-light"><i>*<?= $cover_img_note ?>*</i></label>
                                    </div>
                                    <?php if ($controller_config['disable_blog_status'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12 col-md-4">
                                            <label for="blogStatus">Status<span class="text-danger">*</span></label>
                                            <select class="custom-select" id="blogStatus" name="blogStatus">
                                                <option value="">Select</option>
                                                <option value='1' <?= $blog->active == 1 ? 'selected' : '' ?>>
                                                    Active
                                                </option>
                                                <option value='0' <?= $blog->active != 1 ? 'selected' : '' ?>>
                                                    Inactive
                                                </option>
                                            </select>
                                            <?php echo form_error('blogStatus'); ?>
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
                                        <?php if (!empty($blog->brand_img)) : ?>
                                            <div class="col-sm-12">
                                                <div class="file-img-container">
                                                    <div class="file-img-container-option">
                                                        <a href="javascript:void(0)" class="file_edit_btn trigger_alert_modal" data-title="Confirm" data-desc="Are you sure want to delete this?" data-redirect="<?= base_url('panel/blog/delete_brand_img/' . $blog->id . '/' . $blog->language) ?>"><i class="fas fa-trash"></i> </a>
                                                    </div>
                                                    <img src="<?= base_url('assets/uploads/blog/thumb_' . $blog->brand_img) ?>" class="img-fluid" />
                                                </div>
                                            </div>
                                        <?php endif; ?>

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
                                                            <input type="text" class="form-control" id="blogSeoTitle" placeholder="Title" name="blogSeoTitle" value="<?= set_value('blogSeoTitle', empty($blog->seo_title) ? '' : $blog->seo_title) ?>">
                                                            <?php echo form_error('blogSeoTitle'); ?>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label for="blogSeoMetaKeywords">Meta Keywords</label>
                                                            <textarea class="form-control" id="blogSeoMetaKeywords" placeholder="Meta Keywords" name="blogSeoMetaKeywords"><?= set_value('blogSeoMetaKeywords', empty($blog->seo_meta_keywords) ? '' : $blog->seo_meta_keywords) ?></textarea>
                                                            <?php echo form_error('blogSeoMetaKeywords'); ?>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label for="blogSeoMetaDescription">Meta Description</label>
                                                            <textarea class="form-control" id="blogSeoMetaDescription" placeholder="Meta Description" name="blogSeoMetaDescription"><?= set_value('blogSeoMetaDescription', empty($blog->seo_meta_description) ? '' : $blog->seo_meta_description) ?></textarea>
                                                            <?php echo form_error('blogSeoMetaDescription'); ?>
                                                        </div>
                                                        <?php if ($controller_config['disable_blog_canonical_url'] !== TRUE) : ?>
                                                            <div class="form-group col-sm-12">
                                                                <label for="blogSeoCanonicalUrl">Canonical URL</label>
                                                                <textarea class="form-control" id="blogSeoCanonicalUrl" placeholder="Canonical URL" name="blogSeoCanonicalUrl"><?= set_value('blogSeoCanonicalUrl', empty($blog->seo_canonical_url) ? '' : $blog->seo_canonical_url) ?></textarea>
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
                                    <input type="hidden" name="id" value="<?= set_value('id', empty($blog->id) ? '' : $blog->id) ?>">
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