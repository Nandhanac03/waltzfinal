<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/product/all') ?>">Product</a></li>
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
                        <form role="form" method="post" action="<?= site_url('panel/product/add') ?>" enctype="multipart/form-data" id="productForm">
                            <div class="card-body">
                                <div class="row">
                                    <?php if ($controller_config['disable_pr_category'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12 col-md-4">
                                            <label for="productCategory">Category<span class="text-danger">*</span></label>
                                            <select class="custom-select" id="productCategory" name="productCategory">
                                                <option value="">Select</option>
                                                <?php if ($product_categories) : ?>
                                                    <?php foreach ($product_categories as $category) :
                                                        $space_sl_no = explode('.', $page_info_item['sl_no']);
                                                        array_pop($space_sl_no);
                                                        $space_sl_no = array_sum($space_sl_no);
                                                    ?>
                                                        <option value="<?= $category['category_id'] ?>"><?= str_repeat('&nbsp;&nbsp;&nbsp;', $space_sl_no) ?><?= '(' . $category['sl_no'] . ')&nbsp;&nbsp;' ?><?= $category['title'] ?></option>
                                                        <?php endforeach; ?><?php endif; ?>
                                            </select>
                                            <?php echo form_error('productCategory'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_home_display'] !== TRUE) : ?>
                                        <div class="form-check col-sm-12 col-md-4">
                                            <label for="productCategory">Display in Home Page</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="productHomeDisplay" name="productHomeDisplay" value="1">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Display in Home Page</label>
                                            </div>
                                            <?php echo form_error('productCategory'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_brand'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12 col-md-4">
                                            <label for="productBrand">Brand</label>
                                            <select class="custom-select" id="productBrand" name="productBrand">
                                                <option value="">Select</option>
                                                <?php if ($brands) : ?><?php foreach ($brands as $brand) : ?>
                                                <option value="<?= $brand->id ?>"><?= $brand->brand_name ?></option>
                                                <?php endforeach; ?><?php endif; ?>
                                            </select>
                                            <?php echo form_error('productBrand'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group col-sm-12">
                                        <label for="productName">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productName" placeholder="Name" name="productName" value="<?= set_value('productName') ?>" onchange="generate_slug_title(this, 'productSlugTitle')">
                                        <?php echo form_error('productName'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_pr_title'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productTitle">Title <span class="text-danger"></span></label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productTitle" placeholder="Title" name="productTitle" value="<?= set_value('productTitle') ?>" onchange="generate_slug_title(this, 'productSlugTitle')">
                                            <?php echo form_error('productTitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_slugtitle'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productSlugTitle">Slug Title <span class="text-danger"></span></label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productSlugTitle" placeholder="Slug Title" name="productSlugTitle" value="<?= set_value('productSlugTitle') ?>">
                                            <?php echo form_error('productSlugTitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_subtitle'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productSubtitle">Subtitle</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productSubtitle" placeholder="Subtitle" name="productSubtitle" value="<?= set_value('productSubtitle') ?>">
                                            <?php echo form_error('productSubtitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_author'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productAuthor">Author</label>
                                            <select class="custom-select" id="productAuthor" name="productAuthor">
                                                <option value="">Select</option>
                                                <?php if ($authors) : ?><?php foreach ($authors as $author) : ?>
                                                <option value="<?= $author->id ?>" <?= set_value('productAuthor') == $author->id ? 'selected' : '' ?>><?= $author->name ?></option>
                                                <?php endforeach; ?><?php endif; ?>
                                            </select>
                                            <!-- <input type="text"
                                                   class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                   id="productAuthor" placeholder="Author" name="productAuthor"
                                                   value="<?= set_value('productAuthor') ?>"> -->
                                            <?php echo form_error('productAuthor'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_illustrator'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productIllustrator">Illustrator</label>
                                            <select class="custom-select" id="productIllustrator" name="productIllustrator">
                                                <option value="">Select</option>
                                                <?php if ($illustrators) : ?><?php foreach ($illustrators as $illustrator) : ?>
                                                <option value="<?= $illustrator->id ?>" <?= set_value('productIllustrator') == $illustrator->id ? 'selected' : '' ?>><?= $illustrator->name ?></option>
                                                <?php endforeach; ?><?php endif; ?>
                                            </select>
                                            <!-- <input type="text"
                                                   class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                   id="productIllustrator " placeholder="Illustrator" name="productIllustrator"
                                                   value="<?= set_value('productIllustrator') ?>"> -->
                                            <?php echo form_error('productIllustrator'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_isbn'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productISBN">ISBN</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productISBN" placeholder="ISBN" name="productISBN" value="<?= set_value('productISBN') ?>">
                                            <?php echo form_error('productISBN'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_sku'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productSKU">SKU</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productSKU" placeholder="SKU" name="productSKU" value="<?= set_value('productSKU') ?>">
                                            <?php echo form_error('productSKU'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_short_desc'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productShortDesc">Short Description</label>
                                            <textarea class="form-control ckeditor" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?> id="productShortDesc" placeholder="Short Description" name="productShortDesc"><?= set_value('productShortDesc') ?></textarea>
                                            <?php echo form_error('productShortDesc'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_description'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productDescription">Description</label>
                                            <textarea class="form-control ckeditor" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?> id="productDescription" placeholder="Description" name="productDescription"><?= set_value('productDescription') ?></textarea>
                                            <?php echo form_error('productDescription'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($controller_config['disable_pr_additonal_info'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productAdditonalInfo">Additonal Information</label>
                                            <textarea class="form-control ckeditor" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?> id="productAdditonalInfo" placeholder="Additonal Information" name="productAdditonalInfo"><?= set_value('productAdditonalInfo') ?></textarea>
                                            <?php echo form_error('productAdditonalInfo'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_attributes'] !== TRUE) : ?>
                                        <?= $html_product_attributes ?>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_binding'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productBinding">Binding</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productBinding" placeholder="Binding" name="productBinding" value="<?= set_value('productBinding') ?>">
                                            <?php echo form_error('productBinding'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_no_pages'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productNoPages">No. Of Pages</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productNoPages" placeholder="No. Of Pages" name="productNoPages" value="<?= set_value('productNoPages') ?>">
                                            <?php echo form_error('productNoPages'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_cover_img'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productCoverImg">Cover Image</label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="productCoverImg" id="productCoverImg" accept=".png,.jpg,.jpeg">
                                                <label for="productCoverImg" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <?= form_error('productCoverImg') ?>
                                            <div id="productCoverImgError" class="error-text"><?= $productCoverImgError ?></div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group col-sm-12">
                                        <label for="" class="text-danger"><i>* Image dimension should be 800 x 470px (Width x Height) and less than 100kb in size are recommended. Image types supported include jpg, jpeg and png. *</i></label>
                                    </div>
                                    <?php if ($controller_config['disable_pr_back_cover_img'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productBackCoverImg">Back Cover Image <a href="javascript:void(0)" class="text-info" data-toggle="tooltip" data-placement="top" title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i class="fa fa-info-circle"></i></a></label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="productBackCoverImg" id="productBackCoverImg" accept=".png,.jpg,.jpeg">
                                                <label for="productBackCoverImg" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <?= form_error('productBackCoverImg') ?>
                                            <div id="productCoverImgError" class="error-text"><?= $productBackCoverImgError ?></div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_document'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productDocumentFile">Documents <a href="javascript:void(0)" class="text-info" data-toggle="tooltip" data-placement="top" title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i class="fa fa-info-circle"></i></a></label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" multiple name="productDocumentFile[]" id="productDocumentFile" accept=".pdf">
                                                <label for="productDocumentFile" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <?php if ($productDocumentError) { ?>
                                                <div id="productDocumentError" class="error-text">

                                                    <?= $productDocumentError[0]['error_message'] ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_group'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12 col-md-4">
                                            <label for="productGroup">Group</label>
                                            <select class="custom-select select2" id="productGroup" name="productGroup[]" multiple>
                                                <option value="">Select</option>
                                                <?php if ($product_groups) : ?><?php foreach ($product_groups as $product_group) : ?>
                                                <option value="<?= $product_group->id ?>"><?= $product_group->title ?></option>
                                                <?php endforeach; ?><?php endif; ?>
                                            </select>
                                            <?php echo form_error('productGroup[]'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_qty_per_unty'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productQuantityPerUnit">Quantity Per Unit</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productQuantityPerUnit" placeholder="Quantity Per Unit" name="productQuantityPerUnit" value="<?= set_value('productQuantityPerUnit') ?>">
                                            <?php echo form_error('productQuantityPerUnit'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_units_in_stock'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productUnitsInStock">Units In Stock</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productUnitsInStock" placeholder="Units in stock" name="productUnitsInStock" value="<?= set_value('productUnitsInStock') ?>">
                                            <?php echo form_error('productUnitsInStock'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_manufacturer_retail_price'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productManufacturerRetailPrice">Manufacturer Retail
                                                Price</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productManufacturerRetailPrice" placeholder="Manufacturer Retail Price" name="productManufacturerRetailPrice" value="<?= set_value('productManufacturerRetailPrice') ?>">
                                            <?php echo form_error('productManufacturerRetailPrice'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_unit_price'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productUnitPrice">Unit Price<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productUnitPrice" placeholder="Unit Price" name="productUnitPrice" value="<?= set_value('productUnitPrice') ?>" onchange="find_discount(this.value,$('#productSellingPrice').val(),'productDiscount')">
                                            <?php echo form_error('productUnitPrice'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_discount'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productDiscount">Discount(In %)</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productDiscount" placeholder="Discount" name="productDiscount" value="<?= set_value('productDiscount') ?>" onchange="find_discount_by_percentage($('#productUnitPrice').val(),this.value,'productSellingPrice')">
                                            <?php echo form_error('productDiscount'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_selling_price'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productSellingPrice">Selling Price<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productSellingPrice" placeholder="Selling Price" name="productSellingPrice" value="<?= set_value('productSellingPrice') ?>" onchange="find_discount($('#productUnitPrice').val(),this.value,'productDiscount')">
                                            <?php echo form_error('productSellingPrice'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_note'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productNote">Note</label>
                                            <textarea class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productNote" placeholder="Note" name="productNote"><?= set_value('productNote') ?></textarea>
                                            <?php echo form_error('productNote'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_related_product'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productRelated">Related Products</label>
                                            <select name="productRelated[]" id="productRelated" class="select2_product_search form-control" multiple>
                                                <option>Search</option>
                                            </select>
                                            <?php echo form_error('productRelated'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($controller_config['disable_pr_images'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12" id="productFileContainer">
                                            <label for="productFile">Product Images</label>
                                            <button type="button" class="btn btn-default" onclick="temp_add_product()">
                                                <i class="fas fa-plus-circle"></i> Add File
                                            </button>
                                            <input type="hidden" name="productFilesCount" id="productFilesCount">
                                            <div class="card collapsed-card card-olive mt-3" style="display:none" id="productImagesContainer">
                                                <div class="card-header">
                                                    <h3 class="card-title">Uploaded Product Images</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                            <i class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-12" id="productImagesGridView"></div>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label for="" class="text-danger"><i>* Image dimension should be 300 x 300px (Width x Height) and less than 100kb in size are recommended. Image types supported include jpg, jpeg and png. *</i></label>
                                        </div>
                                    <?php endif; ?>


                                    <?php if ($controller_config['disable_pr_seo'] !== TRUE) : ?>
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
                                                            <label for="productSeoTitle">Title </label>
                                                            <input type="text" class="form-control" id="productSeoTitle" placeholder="Title" name="productSeoTitle" value="<?= set_value('productSeoTitle') ?>">
                                                            <?php echo form_error('productSeoTitle'); ?>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label for="productSeoMetaKeywords">Meta Keywords</label>
                                                            <textarea class="form-control" id="productSeoMetaKeywords" placeholder="Meta Keywords" name="productSeoMetaKeywords"><?= set_value('productSeoMetaKeywords') ?></textarea>
                                                            <?php echo form_error('productSeoMetaKeywords'); ?>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label for="productSeoMetaDescription">Meta Description</label>
                                                            <textarea class="form-control" id="productSeoMetaDescription" placeholder="Meta Description" name="productSeoMetaDescription"><?= set_value('productSeoMetaDescription') ?></textarea>
                                                            <?php echo form_error('productSeoMetaDescription'); ?>
                                                        </div>
                                                        <?php if ($controller_config['disable_pr_canonical_url'] !== TRUE) : ?>
                                                            <div class="form-group col-sm-12">
                                                                <label for="productSeoCanonicalUrl">Canonical URL</label>
                                                                <textarea class="form-control" id="productSeoCanonicalUrl" placeholder="Canonical URL" name="productSeoCanonicalUrl"><?= set_value('productSeoCanonicalUrl') ?></textarea>
                                                                <?php echo form_error('productSeoCanonicalUrl'); ?>
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
                                        <button type="submit" class="btn btn-success float-right">Save
                                        </button>
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
<div class="modal fade" id="productFileAddModal" tabindex="-1" role="dialog" aria-labelledby="productFileAddModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productFileAddModalTitle">Add Product File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="productFileAddModalBody">
                <div class="form-group col-sm-12">
                    <label for="productFileTitle">Title</label>
                    <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productFileTitle" placeholder="Title" name="productFileTitle" value="">
                </div>
                <div class="form-group col-sm-12">
                    <label for="productFileBrowse">Product Image <a href="javascript:void(0)" class="text-info" data-toggle="tooltip" data-placement="top" title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i class="fa fa-info-circle"></i></a></label>
                    <div class="tower-file">
                        <input type="file" class="custom_fileInput" name="productFileBrowse" id="productFileBrowse" accept=".png,.jpg,.jpeg">
                        <label for="productFileBrowse" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse
                        </label>
                        <button type="button" class="tower-file-clear tower-file-button">
                            Clear
                        </button>
                    </div>
                    <div id="productFileAddError" class="error-text"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-redirect="" id="submitProductFileBtn" onclick="temp_add_product_file()">Submit
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="tempProductFileEditModal" tabindex="-1" role="dialog" aria-labelledby="tempProductFileEditModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tempProductFileEditModalTitle">Edit File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="tempProductFileEditModalBody">
                <input type="hidden" name="temp_product_file_id" id="temp_product_file_id">
                <div class="form-group col-sm-12">
                    <label for="tempProductFileTitle">Title</label>
                    <input type="text" class="form-control" id="tempProductFileTitle" placeholder="Title" name="tempProductFileTitle" value="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="temp_submit_product_file()">Submit
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tempDeleteProductFileModal" tabindex="-1" role="dialog" aria-labelledby="tempDeleteProductFileModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tempDeleteProductFileModalTitle">Confirm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="alertModalBody">
                <input type="hidden" name="tempDeleteProductFileId" id="tempDeleteProductFileId">
                <p>Are you sure want to delete this file?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" data-redirect="" id="tempDeleteProductConfirmBtn" onclick="temp_product_file_delete_confirm()">Confirm
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>