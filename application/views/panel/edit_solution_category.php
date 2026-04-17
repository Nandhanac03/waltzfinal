<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Category</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/solution_category/all') ?>">Category</a></li>
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
                        <form role="form" method="post" action="<?= site_url('panel/solution_category/edit/' . $id . '/' . $current_language->id) ?>" enctype="multipart/form-data" id="categoryForm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <?php if ($languages && count($languages) > 1 && $controller_config['disable_languages_category'] != TRUE) : ?>
                                            <ul class="nav nav-tabs mb-4" id="news-content-below-tab" role="tablist">
                                                <?php
                                                $i = 1;
                                                foreach ($languages as $language) :
                                                ?>
                                                    <li class="nav-item">
                                                        <a class="nav-link <?= in_array($language->id, $category_languages) && $language->id != $current_language->id ? ' bg-navy' : '' ?><?= $language->id == $current_language->id ? ' active bg-success' : '' ?>" href="<?= base_url('panel/solution_category/edit/' . $id . '/' . $language->id) ?>" role="tab" aria-selected="true"><?= $language->name ?></a>
                                                    </li>
                                                <?php
                                                endforeach;
                                                ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ($controller_config['disable_parent_category'] != TRUE) : ?>
                                        <div class="form-group col-sm-12" style="<?= $current_language->id != 1 ? 'display:none;' : '' ?>">
                                            <label for="parentCategory">Parent Category</label>
                                            <select class="custom-select" id="parentCategory" name="parentCategory">
                                                <option value="">None</option>
                                                <?php if ($categories) : ?><?php foreach ($categories as $category_item) :
                                                                                $space_sl_no = explode('.', $category_item['sl_no']);
                                                                                array_pop($space_sl_no);
                                                                                $space_sl_no = array_sum($space_sl_no);
                                                                                $space_sl_no = '0';
                                                                            ?>
                                                <option value="<?= $category_item['category_id'] ?>" <?= !empty($category->parent_id) && $category->parent_id == $category_item['category_id'] ? 'selected' : '' ?>><?= str_repeat('&nbsp;&nbsp;&nbsp;', $space_sl_no) ?><?= '(' . $category_item['sl_no'] . ')&nbsp;&nbsp;' ?><?= $category_item['title'] ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                            </select>
                                            <?php echo form_error('parentCategory'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group col-sm-12">
                                        <label for="categoryTitle">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="categoryTitle" placeholder="Title" name="categoryTitle" value="<?= set_value('categoryTitle', empty($category->title) ? '' : $category->title) ?>" onchange="generate_slug_title(this, 'categorySlugTitle')">
                                        <?php echo form_error('categoryTitle'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_category_slug_title'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="categorySlugTitle">Slug Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="categorySlugTitle" placeholder="Slug Title" name="categorySlugTitle" value="<?= set_value('categorySlugTitle', empty($category->title_slug) ? '' : $category->title_slug) ?>">
                                            <?php echo form_error('categorySlugTitle'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($controller_config['disable_categoryShortDesc'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="categoryShortDesc">Short Description</label>
                                            <textarea class="form-control ckeditor" id="categoryShortDesc" placeholder="Short Description" name="categoryShortDesc"><?= set_value('categoryShortDesc', empty($category->short_desc) ? '' : $category->short_desc) ?></textarea>
                                            <?php echo form_error('categoryShortDesc'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($controller_config['disable_pr_cover_img'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="categoryCoverImg">Cover Image</label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="categoryCoverImg" id="categoryCoverImg" accept=".png,.jpg,.jpeg">
                                                <label for="categoryCoverImg" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <?= form_error('categoryCoverImg') ?>
                                            <div id="categoryCoverImgError" class="error-text"><?= $categoryCoverImgError ?></div>
                                        </div>
                                        <?php if (!empty($category->description)) : ?>
                                            <div class="col-sm-12">
                                                <div class="file-img-container">
                                                    <div class="file-img-container-option">
                                                        <a href="javascript:void(0)" class="file_edit_btn trigger_alert_modal" data-title="Confirm" data-desc="Are you sure want to delete this?" data-redirect="<?= base_url('panel/solution_category/delete_cover_img/' . $category->id . '/' . $category->language) ?>"><i class="fas fa-trash"></i> </a>
                                                    </div>
                                                    <img src="<?= base_url('assets/uploads/solution/thumb_' . $category->description) ?>" class="img-fluid" />
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>


                                    <?php if ($controller_config['disable_category_status'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12 col-md-4">
                                            <label for="categoryStatus">Status<span class="text-danger">*</span></label>
                                            <select class="custom-select" id="categoryStatus" name="categoryStatus">
                                                <option value="">Select</option>
                                                <option value='1' <?= $category->active == 1 ? 'selected' : '' ?>>
                                                    Active
                                                </option>
                                                <option value='0' <?= $category->active != 1 ? 'selected' : '' ?>>
                                                    Inactive
                                                </option>
                                            </select>
                                            <?php echo form_error('categoryStatus'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_solution_category_seo'] !== TRUE) : ?>
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
                                                            <label for="categorySeoTitle">Title </label>
                                                            <input type="text" class="form-control" id="categorySeoTitle" placeholder="Title" name="categorySeoTitle" value="<?= set_value('categorySeoTitle', empty($category->seo_title) ? '' : $category->seo_title) ?>">
                                                            <?php echo form_error('categorySeoTitle'); ?>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label for="categorySeoMetaKeywords">Meta Keywords</label>
                                                            <textarea class="form-control" id="categorySeoMetaKeywords" placeholder="Meta Keywords" name="categorySeoMetaKeywords"><?= set_value('categorySeoMetaKeywords', empty($category->seo_meta_keywords) ? '' : $category->seo_meta_keywords) ?></textarea>
                                                            <?php echo form_error('categorySeoMetaKeywords'); ?>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label for="categorySeoMetaDescription">Meta Description</label>
                                                            <textarea class="form-control" id="categorySeoMetaDescription" placeholder="Meta Description" name="categorySeoMetaDescription"><?= set_value('categorySeoMetaDescription', empty($category->seo_meta_description) ? '' : $category->seo_meta_description) ?></textarea>
                                                            <?php echo form_error('categorySeoMetaDescription'); ?>
                                                        </div>
                                                        <?php if ($controller_config['disable_category_canonical_url'] !== TRUE) : ?>
                                                            <div class="form-group col-sm-12">
                                                                <label for="categorySeoCanonicalUrl">Canonical URL</label>
                                                                <textarea class="form-control" id="categorySeoCanonicalUrl" placeholder="Canonical URL" name="categorySeoCanonicalUrl"><?= set_value('categorySeoCanonicalUrl', empty($category->seo_canonical_url) ? '' : $category->seo_canonical_url) ?></textarea>
                                                                <?php echo form_error('categorySeoCanonicalUrl'); ?>
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