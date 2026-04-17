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
                <?php if ($controller_config['disable_pr_variant'] !== TRUE) : ?>
                    <div class="col-sm-2">
                        <ul class="nav nav-tabs flex-column mb-4" id="product-content-below-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link <?= $active_menu_group == 'product' ? 'bg-info' : 'bg-gray-dark' ?>" style="border-radius: 0;" href="<?= base_url('panel/product/edit/' . $id) ?>" role="tab" aria-selected="true">General</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $active_menu_group == 'product_variant' ? 'bg-info' : 'bg-gray-dark' ?>" style="border-radius: 0;" href="<?= base_url('panel/product_variant/add/' . $id) ?>" role="tab" aria-selected="true">Variant</a>
                            </li>
                        </ul>
                    </div>
                <?php endif; ?>
                <div class="<?= $controller_config['disable_pr_variant'] !== TRUE ? 'col-sm-10' : 'col-sm-12'; ?>">
                    <?= $alert ?>
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Edit</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <!-- form start -->
                            <form role="form" method="post" action="<?= site_url('panel/product/edit/' . $id . '/' . $current_language->id) ?>" enctype="multipart/form-data" id="productForm">
                                <!-- hidden-->
                                <input type="hidden" name="hid_lang_id" value="<?= $current_language->id ?>" id="hid_lang_id">
                                <input type="hidden" name="hid_product_id" value="<?= $id ?>" id="hid_product_id">
                                <?php if ($languages && count($languages) > 1 && $controller_config['disable_pr_languages'] != TRUE) : ?>
                                    <ul class="nav nav-tabs mb-4" id="product-content-below-tab" role="tablist">
                                        <?php
                                        $i = 1;
                                        foreach ($languages as $language) :
                                        ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?= in_array($language->id, $product_languages) && $language->id != $current_language->id ? ' bg-navy' : '' ?><?= $language->id == $current_language->id ? ' active bg-success' : '' ?>" href="<?= base_url('panel/product/edit/' . $id . '/' . $language->id) ?>" role="tab" aria-selected="true"><?= $language->name ?></a>
                                            </li>
                                        <?php
                                        endforeach;
                                        ?>
                                    </ul>
                                <?php endif; ?>
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
                                                        <option value="<?= $category['category_id'] ?>" <?= !empty($parent_product->category_id) && $parent_product->category_id == $category['category_id'] ? 'selected' : '' ?>><?= str_repeat('&nbsp;&nbsp;&nbsp;', $space_sl_no) ?><?= '(' . $category['sl_no'] . ')&nbsp;&nbsp;' ?><?= $category['title'] ?></option>
                                                        <?php endforeach; ?><?php endif; ?>
                                            </select>
                                            <?php echo form_error('productCategory'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_home_display'] !== TRUE) : ?>
                                        <div class="form-check col-sm-12 col-md-4">
                                            <label for="productCategory">Display in Home Page</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="productHomeDisplay" name="productHomeDisplay" value="1" <?php if ($product->home_display == 1) {
                                                                                                                                                                echo "checked";
                                                                                                                                                            } ?>>
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
                                                <option value="<?= $brand->id ?>" <?= !empty($parent_product->brand_id) && $parent_product->brand_id == $brand->id ? 'selected' : '' ?>><?= $brand->brand_name ?></option>
                                                <?php endforeach; ?><?php endif; ?>
                                            </select>
                                            <?php echo form_error('productBrand'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <!-- <div class="form-group col-sm-12">
                        git branch -M main                <label for="productName">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productName" placeholder="Name" name="productName" value="<?= set_value('productName', empty($product->product_name) ? '' : $product->product_name) ?>">
                                        <?php echo form_error('productName'); ?>
                                    </div> -->
                                    <?php if ($controller_config['disable_pr_code'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productName">Product Code</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productCode" placeholder="Product Code" name="productCode" value="<?= set_value('productCode', empty($product->product_code) ? '' : $product->product_code) ?>">
                                            <?php echo form_error('productCode'); ?>
                                        </div>
                                    <?php endif; ?>


                                    <?php if ($controller_config['disable_pr_title'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productName">Name <span class="text-danger"></span></label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productName" placeholder="Title" name="productName" value="<?= set_value('productName', empty($product->product_name) ? '' : $product->product_name) ?>" onchange="generate_slug_title(this, 'productSlugTitle')">
                                            <?php echo form_error('productName'); ?>
                                        </div>
                                    <?php endif; ?>


                                    <!-- <?php //if ($controller_config['disable_pr_title'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productTitle">Title <span class="text-danger"></span></label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productTitle" placeholder="Title" name="productTitle" value="<?= set_value('productTitle', empty($product->title) ? '' : $product->title) ?>" onchange="generate_slug_title(this, 'productSlugTitle')">
                                            <?php echo form_error('productTitle'); ?>
                                        </div>
                                    <?php //endif; ?> -->
                                    <?php if ($controller_config['disable_pr_slugtitle'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productSlugTitle">Slug Title <span class="text-danger"></span></label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productSlugTitle" placeholder="Slug Title" name="productSlugTitle" value="<?= set_value('productSlugTitle', empty($product->title_slug) ? '' : $product->title_slug) ?>">
                                            <?php echo form_error('productSlugTitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_subtitle'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productSubtitle">Subtitle</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productSubtitle" placeholder="Subtitle" name="productSubtitle" value="<?= set_value('productSubtitle', empty($product->subtitle) ? '' : $product->subtitle) ?>">
                                            <?php echo form_error('productSubtitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_author'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productAuthor">Author</label>
                                            <select class="custom-select" id="productAuthor" name="productAuthor">
                                                <option value="">Select</option>
                                                <?php if ($authors) : ?><?php foreach ($authors as $author) : ?>
                                                <option value="<?= $author->id ?>" <?= set_value('productAuthor', empty($product->author) ? '' : $product->author) == $author->id ? 'selected' : '' ?>><?= $author->name ?></option>
                                                <?php endforeach; ?><?php endif; ?>
                                            </select>
                                            <!-- <input type="text"
                                                       class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                       id="productAuthor" placeholder="Author" name="productAuthor"
                                                       value="<?= set_value('productAuthor', empty($product->author) ? '' : $product->author) ?>"> -->
                                            <?php echo form_error('productAuthor'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_illustrator'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productIllustrator">Illustrator</label>
                                            <select class="custom-select" id="productIllustrator" name="productIllustrator">
                                                <option value="">Select</option>
                                                <?php if ($illustrators) : ?><?php foreach ($illustrators as $illustrator) : ?>
                                                <option value="<?= $illustrator->id ?>" <?= set_value('productIllustrator', empty($product->illustrator) ? '' : $product->illustrator) == $illustrator->id ? 'selected' : '' ?>><?= $illustrator->name ?></option>
                                                <?php endforeach; ?><?php endif; ?>
                                            </select>
                                            <!-- <input type="text"
                                                       class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                       id="productIllustrator " placeholder="Illustrator" name="productIllustrator"
                                                       value="<?= set_value('productIllustrator', empty($product->illustrator) ? '' : $product->illustrator) ?>"> -->
                                            <?php echo form_error('productIllustrator'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_isbn'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productISBN">ISBN</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productISBN" placeholder="ISBN" name="productISBN" value="<?= set_value('productISBN', empty($product->isbn) ? '' : $product->isbn) ?>">
                                            <?php echo form_error('productISBN'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_sku'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productSKU">SKU</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productSKU" placeholder="SKU" name="productSKU" value="<?= set_value('productSKU', empty($product->sku) ? '' : $product->sku) ?>">
                                            <?php echo form_error('productSKU'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_short_desc'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productShortDesc">Short Description</label>
                                            <textarea class="form-control ckeditor" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?> id="productShortDesc" placeholder="Short Description" name="productShortDesc"><?= set_value('productShortDesc', empty($product->short_desc) ? '' : $product->short_desc) ?></textarea>
                                            <?php echo form_error('productShortDesc'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group col-sm-12">
                                        <label for="productDescription">Description</label>
                                        <textarea class="form-control ckeditor" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?> id="productDescription" placeholder="Description" name="productDescription"><?= set_value('productDescription', empty($product->description) ? '' : $product->description) ?></textarea>
                                        <?php echo form_error('productDescription'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_pr_additonal_info'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productAdditonalInfo">Additonal Information</label>
                                            <textarea class="form-control ckeditor" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?> id="productAdditonalInfo" placeholder="Additonal Information" name="productAdditonalInfo"><?= set_value('productAdditonalInfo', empty($product->additonal_info) ? '' : $product->additonal_info) ?></textarea>
                                            <?php echo form_error('productAdditonalInfo'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_attributes'] !== TRUE) : ?>
                                        <?= $html_product_attributes ?>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_binding'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productBinding">Binding</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productBinding" placeholder="Binding" name="productBinding" value="<?= set_value('productBinding', empty($product->binding) ? '' : $product->binding) ?>">
                                            <?php echo form_error('productBinding'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_no_pages'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productNoPages">No. Of Pages</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productNoPages" placeholder="No. Of Pages" name="productNoPages" value="<?= set_value('productNoPages', empty($product->no_of_pages) ? '' : $product->no_of_pages) ?>">
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
                                        <?php if (!empty($product->product_cover)) : ?>
                                            <div class="col-sm-12">
                                                <div class="file-img-container">
                                                    <div class="file-img-container-option">
                                                        <a href="javascript:void(0)" class="file_edit_btn trigger_alert_modal" data-title="Confirm" data-desc="Are you sure want to delete this?" data-redirect="<?= base_url('panel/product/delete_cover_img/' . $product->id . '/' . $product->language) ?>"><i class="fas fa-trash"></i> </a>
                                                    </div>
                                                    <img src="<?= base_url('assets/uploads/product/thumb_' . $product->product_cover) ?>" class="img-fluid" />
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="form-group col-sm-12">
                                        <label for="" class="text-danger"><i>* Image dimension should be 800 x 470px (Width x Height) and less than 100kb in size are recommended. Image types supported include jpg, jpeg and png. *</i></label>
                                    </div>
                                    <?php if ($controller_config['disable_pr_back_cover_img'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productCoverImg">Back Cover Image <a href="javascript:void(0)" class="text-info" data-toggle="tooltip" data-placement="top" title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i class="fa fa-info-circle"></i></a></label>
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
                                        <?php if (!empty($product->product_back_cover)) : ?>
                                            <div class="col-sm-12">
                                                <div class="file-img-container">
                                                    <div class="file-img-container-option">
                                                        <a href="javascript:void(0)" class="file_edit_btn trigger_alert_modal" data-title="Confirm" data-desc="Are you sure want to delete this?" data-redirect="<?= base_url('panel/product/delete_back_cover_img/' . $product->id . '/' . $product->language) ?>"><i class="fas fa-trash"></i> </a>
                                                    </div>
                                                    <img src="<?= base_url('assets/uploads/product/thumb_' . $product->product_back_cover) ?>" class="img-fluid" />
                                                </div>
                                            </div>
                                        <?php endif; ?>
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
                                            <?php if($productDocumentError){?>
                                            <div id="productDocumentError" class="error-text">

                                                <?= $productDocumentError[0]['error_message'] ?>
                                            </div>
                                            <?php }?>
                                        </div>
                                        <?php if (!empty($product_documents)) : $i = 1; ?>
                                            <div class="col-sm-12 col-md-4">
                                                <table class="table table-bordered table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="2" class="text-center">Uploaded Doucuments</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($product_documents as $product_document) : ?>
                                                            <tr id="prod-doc-<?= $product_document->id ?>">
                                                                <td>
                                                                    <a href="<?= base_url('assets/uploads/document/' . $product_document->file) ?>" target="_blank" class="ml-2">
                                                                        <i class="fas fa-file-alt fa-2x"></i>
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control product-doc-title-input"
                                                                        data-id="<?= $product_document->id ?>"
                                                                        value="<?= htmlspecialchars($product_document->title ?? 'Document ' . $i) ?>">
                                                                </td>
                                                                <td align="center">
                                                                    <a href="<?= base_url('panel/product/delete_product_document/' . $product_document->product_id . '/' . $product_document->id) ?>"
                                                                        class="text-danger" title="Delete">
                                                                        <i class="fas fa-trash"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <?php $i++; ?>
                                                        <?php endforeach; ?>
                                                    </tbody>

                                                </table>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php
                                    if ($controller_config['disable_pr_group'] !== TRUE) :
                                    ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productGroup">Group</label>
                                            <select class="custom-select select2" id="productGroup" name="productGroup[]" multiple>
                                                <option value="">Select</option>
                                                <?php if ($product_groups) : ?><?php foreach ($product_groups as $product_group) : ?>
                                                <option value="<?= $product_group->id ?>" <?= !empty($parent_product->product_group) && in_array($product_group->id, explode(',', $product->product_group)) ? 'selected' : '' ?>><?= $product_group->title ?></option>
                                                <?php endforeach; ?><?php endif; ?>
                                            </select>
                                            <?php echo form_error('productGroup[]'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_qty_per_unty'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productQuantityPerUnit">Quantity Per Unit</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productQuantityPerUnit" placeholder="Quantity Per Unit" name="productQuantityPerUnit" value="<?= set_value('productQuantityPerUnit', empty($product->quantity_per_unit) ? '' : $product->quantity_per_unit) ?>">
                                            <?php echo form_error('productQuantityPerUnit'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_units_in_stock'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productUnitsInStock">Units In Stock</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productUnitsInStock" placeholder="Units in stock" name="productUnitsInStock" value="<?= set_value('productUnitsInStock', empty($product->units_in_stock) ? '' : $product->units_in_stock) ?>">
                                            <?php echo form_error('productUnitsInStock'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_manufacturer_retail_price'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productManufacturerRetailPrice">Manufacturer Retail
                                                Price</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productManufacturerRetailPrice" placeholder="Manufacturer Retail Price" name="productManufacturerRetailPrice" value="<?= set_value('productManufacturerRetailPrice', empty($product->manufacturer_retail_price) ? '' : $product->manufacturer_retail_price) ?>">
                                            <?php echo form_error('productManufacturerRetailPrice'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_unit_price'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productUnitPrice">Unit Price<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productUnitPrice" placeholder="Unit Price" name="productUnitPrice" value="<?= set_value('productUnitPrice', empty($product->unit_price) ? '' : $product->unit_price) ?>" onchange="find_discount(this.value,$('#productSellingPrice').val(),'productDiscount')">
                                            <?php echo form_error('productUnitPrice'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_discount'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productDiscount">Discount(In %)</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productDiscount" placeholder="Discount" name="productDiscount" value="<?= set_value('productDiscount', empty($product->discount) ? '' : $product->discount) ?>" onchange="find_discount_by_percentage($('#productUnitPrice').val(),this.value,'productSellingPrice')">
                                            <?php echo form_error('productDiscount'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_selling_price'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productSellingPrice">Selling Price<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productSellingPrice" placeholder="Selling Price" name="productSellingPrice" value="<?= set_value('productSellingPrice', empty($product->selling_price) ? '' : $product->selling_price) ?>" onchange="find_discount($('#productUnitPrice').val(),this.value,'productDiscount')">
                                            <?php echo form_error('productSellingPrice'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_note'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productNote">Note</label>
                                            <textarea class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productNote" placeholder="Note" name="productNote"><?= set_value('productNote', empty($product->note) ? '' : $product->note) ?></textarea>
                                            <?php echo form_error('productNote'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_related_product'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productRelated">Related Products</label>
                                            <select name="productRelated[]" id="productRelated" class="select2_product_search form-control" multiple>
                                                <option>Search</option>
                                                <?php
                                                if ($related_products) :
                                                    foreach ($related_products as $related_product) :
                                                ?>
                                                        <option value="<?= $related_product->id ?>" selected><?= $related_product->product_name ?></option>
                                                <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </select>
                                            <?php echo form_error('productRelated'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($controller_config['disable_pr_images'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12" id="productProductFileContainer">
                                            <label for="productProductFile">Product Images</label>
                                            <button type="button" class="btn btn-default" onclick="product_update_modal_show()">
                                                <i class="fas fa-plus-circle"></i> Add File
                                            </button>
                                            <div class="card collapsed-card card-olive mt-3" style="<?= !$product_images ? 'display:none' : '' ?>" id="productImagesContainer">
                                                <div class="card-header">
                                                    <h3 class="card-title">Uploaded Product Images</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                            <i class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-12" id="productImagesGridView">
                                                            <?php if ($product_images) : foreach ($product_images as $product_image) : ?>
                                                                    <div class="file-img-container">
                                                                        <div class="file-img-container-option">
                                                                            <a href="javascript:void(0)" class="file_edit_btn" title="Delete" onclick="product_file_delete('<?= $product_image->id ?>')"><i class="fas fa-trash"></i> </a>
                                                                            <a href="<?= base_url('panel/product/edit_file/' . $product_image->product_id . '/' . $product_image->id) ?>" class="file_edit_btn" title="Edit" data-file-title="<?= $product_image->title ?>"><i class="fas fa-edit"></i> </a>
                                                                        </div>
                                                                        <img src="<?= base_url('assets/uploads/product/thumb_' . $product_image->file) ?>" class="img-fluid" />
                                                                        <div class="file-img-title"><span title="<?= $product_image->title ?>"><?= $product_image->title ?: '--' ?></span>
                                                                        </div>
                                                                    </div>
                                                            <?php
                                                                endforeach;
                                                            endif;
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group col-sm-12">
                                            <label for="" class="text-danger"><i>* Image dimension should be 300 x 300px (Width x Height) and less than 100kb in size are recommended. Image types supported include jpg, jpeg and png. *</i></label>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_status'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12 col-md-4">
                                            <label for="productStatus">Status<span class="text-danger">*</span></label>
                                            <select class="custom-select" id="productStatus" name="productStatus">
                                                <option value='Y' <?= $product->active == '1' ? 'selected' : '' ?>>
                                                    Active
                                                </option>
                                                <option value='N' <?= $product->active != '1' ? 'selected' : '' ?>>
                                                    Inactive
                                                </option>
                                            </select>
                                            <?php echo form_error('productStatus'); ?>
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
                                                            <input type="text" class="form-control" id="productSeoTitle" placeholder="Title" name="productSeoTitle" value="<?= set_value('productSeoTitle', empty($product->seo_title) ? '' : $product->seo_title) ?>">
                                                            <?php echo form_error('productSeoTitle'); ?>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label for="productSeoMetaKeywords">Meta Keywords</label>
                                                            <textarea class="form-control" id="productSeoMetaKeywords" placeholder="Meta Keywords" name="productSeoMetaKeywords"><?= set_value('productSeoMetaKeywords', empty($product->seo_meta_keywords) ? '' : $product->seo_meta_keywords) ?></textarea>
                                                            <?php echo form_error('productSeoMetaKeywords'); ?>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label for="productSeoMetaDescription">Meta Description</label>
                                                            <textarea class="form-control" id="productSeoMetaDescription" placeholder="Meta Description" name="productSeoMetaDescription"><?= set_value('productSeoMetaDescription', empty($product->seo_meta_description) ? '' : $product->seo_meta_description) ?></textarea>
                                                            <?php echo form_error('productSeoMetaDescription'); ?>
                                                        </div>
                                                        <?php if ($controller_config['disable_pr_canonical_url'] !== TRUE) : ?>
                                                            <div class="form-group col-sm-12">
                                                                <label for="productSeoCanonicalUrl">Canonical URL</label>
                                                                <textarea class="form-control" id="productSeoCanonicalUrl" placeholder="Canonical URL" name="productSeoCanonicalUrl"><?= set_value('productSeoCanonicalUrl', empty($product->seo_canonical_url) ? '' : $product->seo_canonical_url) ?></textarea>
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<div class="modal fade" id="productFileUpdateModal" tabindex="-1" role="dialog" aria-labelledby="productFileUpdateModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?= base_url('panel/product/ajax_add_product_file/' . $id . '/' . $lang) ?>" method="post" id="productFileUpdateModalForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="productFileUpdateModalTitle">Add Product File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="productFileUpdateModalBody">
                    <div class="form-group col-sm-12">
                        <label for="productFileUpdateTitle">Title</label>
                        <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productFileUpdateTitle" placeholder="Title" name="productFileUpdateTitle" value="">
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="productFileUpdateBrowse">Product Image <a href="javascript:void(0)" class="text-info" data-toggle="tooltip" data-placement="top" title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i class="fa fa-info-circle"></i></a></label>
                        <div class="tower-file">
                            <input type="file" class="custom_fileInput" name="productFileUpdateBrowse" id="productFileUpdateBrowse" accept=".png,.jpg,.jpeg">
                            <label for="productFileUpdateBrowse" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse </label>
                            <button type="button" class="tower-file-clear tower-file-button">
                                Clear
                            </button>
                        </div>
                        <div id="productFileUpdateError" class="error-text"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-redirect="" id="submitProductFileUpdateBtn">
                        Submit
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="productFileEditModal" tabindex="-1" role="dialog" aria-labelledby="productFileEditModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?= base_url('panel/product/ajax_product_file_description/' . $id . '/' . $lang) ?>" method="post" id="productFileEditModalForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="productFileEditModalTitle">Edit File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="productFileEditModalBody">
                    <input type="hidden" name="product_file_id" id="product_file_id">
                    <div class="form-group col-sm-12">
                        <label for="productFileTitle">Title</label>
                        <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="productFileTitle" placeholder="Title" name="productFileTitle" value="">
                        <div id="productFileEditError" class="error-text"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-redirect="" id="productFileEditModalBtn">
                        Submit
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteProductFileModal" tabindex="-1" role="dialog" aria-labelledby="deleteProductFileModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?= base_url('panel/product/ajax_delete_product_file/' . $id . '/' . $lang) ?>" method="post" id="deleteProductFileModalForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteProductFileModalTitle">Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="deleteProductFileModalBody">
                    <input type="hidden" name="deleteProductFileId" id="deleteProductFileId">
                    <p>Are you sure want to delete this file?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-redirect="" id="deleteProductConfirmBtn">
                        Confirm
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="productVariantAddModal" tabindex="-1" role="dialog" aria-labelledby="productVariantAddModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productVariantAddModalTitle">Add Variant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="productVariantAddModalBody">

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" data-redirect="" id="productVariantAddBtn">
                    Add
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>

<script>
    $(document).on('change', '.product-doc-title-input', function() {
        let input = $(this);
        let docId = input.data('id');
        let newTitle = input.val();

        // Reset validation states first
        input.removeClass("is-valid is-invalid");

        $.ajax({
            url: "<?= base_url('panel/product/ajax_update_product_document_title') ?>",
            type: "POST",
            data: {
                doc_id: docId,
                title: newTitle
            },
            dataType: 'json', // <- important
            success: function(response) {
                if (response.success) {
                    input.addClass("is-valid");
                } else {
                    input.addClass("is-invalid");
                }
                setTimeout(() => input.removeClass("is-valid is-invalid"), 2000);
            },
            error: function() {
                input.addClass("is-invalid");
                setTimeout(() => input.removeClass("is-invalid"), 2000);
            }
        });

    });
</script>