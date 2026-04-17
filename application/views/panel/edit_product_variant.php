<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Product Variant</h1>
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
                <div class="col-sm-2">
                    <ul class="nav nav-tabs flex-column mb-4" id="product-content-below-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link <?=$active_menu_group=='product'?'bg-info':'bg-gray-dark'?>"
                               style="border-radius: 0;"
                               href="<?= base_url('panel/product/edit/' . $id ) ?>"
                               role="tab" aria-selected="true">General</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?=$active_menu_group=='product_variant'?'bg-info':'bg-gray-dark'?>"
                               style="border-radius: 0;"
                               href="<?= base_url('panel/product_variant/add/' . $id ) ?>"
                               role="tab" aria-selected="true">Variant</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-10">
                    <?= $alert ?>
                    <?php
                      echo validation_errors();                    
                    ?>
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Edit</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <!-- form start -->
                            <form role="form" method="post"
                                  action="<?= site_url('panel/product_variant/edit/' . $id . '/'. $parent_variant_product->id.'/'. $current_language->id) ?>"
                                  enctype="multipart/form-data" id="productForm">
                                <!-- hidden-->
                                <input type="hidden" name="hid_lang_id" value="<?= $current_language->id ?>"
                                       id="hid_lang_id">
                                <input type="hidden" name="hid_product_id" value="<?= $id ?>" id="hid_product_id">
                                <?php if ($languages && count($languages) > 1 && $controller_config['disable_pr_languages'] != TRUE): ?>
                                    <ul class="nav nav-tabs mb-4" id="product-content-below-tab" role="tablist">
                                        <?php
                                        $i = 1;
                                        foreach ($languages as $language):
                                            ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?= in_array($language->id, $product_variant_languages) && $language->id != $current_language->id ? ' bg-navy' : '' ?><?= $language->id == $current_language->id ? ' active bg-success' : '' ?>"
                                                   href="<?= base_url('panel/product/edit/' . $id . '/' . $language->id) ?>"
                                                   role="tab" aria-selected="true"><?= $language->name ?></a>
                                            </li>
                                        <?php
                                        endforeach;
                                        ?>
                                    </ul>
                                <?php endif; ?>
                                <div class="row">
                                    <?php if ($controller_config['disable_pr_code'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productName">Product Code</label>
                                            <input type="text"
                                                   class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                   id="productCode" placeholder="Product Code" name="productCode"
                                                   value="<?= set_value('productCode', empty($product_variant->product_code) ? '' : $product_variant->product_code) ?>">
                                            <?php echo form_error('productCode'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_sku'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productSKU">SKU</label>
                                            <input type="text"
                                                   class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                   id="productSKU" placeholder="SKU" name="productSKU"
                                                   value="<?= set_value('productSKU', empty($product_variant->sku) ? '' : $product_variant->sku) ?>">
                                            <?php echo form_error('productSKU'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_attributes'] !== TRUE): ?>
                                        <?= $html_product_attributes ?>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_cover_img'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productCoverImg">Cover Image <a href="javascript:void(0)"
                                                                                        class="text-info"
                                                                                        data-toggle="tooltip"
                                                                                        data-placement="top"
                                                                                        title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i
                                                            class="fa fa-info-circle"></i></a></label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="productCoverImg"
                                                       id="productCoverImg" accept=".png,.jpg,.jpeg">
                                                <label for="productCoverImg" class="tower-file-button"> <span
                                                            class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <?= form_error('productCoverImg') ?>
                                            <div id="productCoverImgError"
                                                 class="error-text"><?= $product_variantCoverImgError ?></div>
                                        </div>
                                        <?php if (!empty($product_variant->product_cover)): ?>
                                            <div class="col-sm-12">
                                                <div class="file-img-container">
                                                    <div class="file-img-container-option">
                                                        <a href="javascript:void(0)"
                                                           class="file_edit_btn trigger_alert_modal"
                                                           data-title="Confirm"
                                                           data-desc="Are you sure want to delete this?"
                                                           data-redirect="<?= base_url('panel/product_variant/delete_cover_img/' . $product_variant->id . '/' . $product_variant->language) ?>"><i
                                                                    class="fas fa-trash"></i> </a>
                                                    </div>
                                                    <img src="<?= base_url('assets/uploads/product/thumb_' . $product_variant->product_cover) ?>"
                                                         class="img-fluid"/>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_qty_per_unty'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productQuantityPerUnit">Quantity Per Unit</label>
                                            <input type="text"
                                                   class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                   id="productQuantityPerUnit" placeholder="Quantity Per Unit"
                                                   name="productQuantityPerUnit"
                                                   value="<?= set_value('productQuantityPerUnit', empty($product_variant->quantity_per_unit) ? '' : $product_variant->quantity_per_unit) ?>">
                                            <?php echo form_error('productQuantityPerUnit'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_units_in_stock'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productUnitsInStock">Units In Stock</label>
                                            <input type="text"
                                                   class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                   id="productUnitsInStock" placeholder="Units in stock"
                                                   name="productUnitsInStock"
                                                   value="<?= set_value('productUnitsInStock', empty($product_variant->units_in_stock) ? '' : $product_variant->units_in_stock) ?>">
                                            <?php echo form_error('productUnitsInStock'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_manufacturer_retail_price'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productManufacturerRetailPrice">Manufacturer Retail
                                                Price</label>
                                            <input type="text"
                                                   class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                   id="productManufacturerRetailPrice"
                                                   placeholder="Manufacturer Retail Price"
                                                   name="productManufacturerRetailPrice"
                                                   value="<?= set_value('productManufacturerRetailPrice', empty($product_variant->manufacturer_retail_price) ? '' : $product_variant->manufacturer_retail_price) ?>">
                                            <?php echo form_error('productManufacturerRetailPrice'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_unit_price'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productUnitPrice">Unit Price<span
                                                        class="text-danger">*</span></label>
                                            <input type="text"
                                                   class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                   id="productUnitPrice" placeholder="Unit Price"
                                                   name="productUnitPrice"
                                                   value="<?= set_value('productUnitPrice', empty($product_variant->unit_price) ? '' : $product_variant->unit_price) ?>">
                                            <?php echo form_error('productUnitPrice'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_discount'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productDiscount">Discount</label>
                                            <input type="text"
                                                   class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                   id="productDiscount" placeholder="Discount"
                                                   name="productDiscount"
                                                   value="<?= set_value('productDiscount', empty($product_variant->discount) ? '' : $product_variant->discount) ?>">
                                            <?php echo form_error('productDiscount'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_selling_price'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="productSellingPrice">Selling Price<span
                                                        class="text-danger">*</span></label>
                                            <input type="text"
                                                   class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                   id="productSellingPrice" placeholder="Selling Price"
                                                   name="productSellingPrice"
                                                   value="<?= set_value('productSellingPrice', empty($product_variant->selling_price) ? '' : $product_variant->selling_price) ?>">
                                            <?php echo form_error('productSellingPrice'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_status'] !== TRUE): ?>
                                        <div class="form-group col-sm-12 col-md-4">
                                            <label for="productStatus">Status<span
                                                        class="text-danger">*</span></label>
                                            <select class="custom-select" id="productStatus" name="productStatus">
                                                <option value="">Select</option>
                                                <option value='Y' <?= $parent_variant_product->active == 1 ? 'selected' : '' ?>>
                                                    Enabled
                                                </option>
                                                <option value='N' <?= $parent_variant_product->active != 1 ? 'selected' : '' ?>>
                                                    Disabled
                                                </option>
                                            </select>
                                            <?php echo form_error('productStatus'); ?>
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
<div class="modal fade" id="productFileUpdateModal" tabindex="-1" role="dialog"
     aria-labelledby="productFileUpdateModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?= base_url('panel/product/ajax_add_product_file/' . $id . '/' . $lang) ?>" method="post"
                  id="productFileUpdateModalForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="productFileUpdateModalTitle">Add Product File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="productFileUpdateModalBody">
                    <div class="form-group col-sm-12">
                        <label for="productFileUpdateTitle">Title</label>
                        <input type="text"
                               class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                               id="productFileUpdateTitle" placeholder="Title" name="productFileUpdateTitle" value="">
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="productFileUpdateBrowse">Product Image <a href="javascript:void(0)"
                                                                              class="text-info" data-toggle="tooltip"
                                                                              data-placement="top"
                                                                              title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i
                                        class="fa fa-info-circle"></i></a></label>
                        <div class="tower-file">
                            <input type="file" class="custom_fileInput" name="productFileUpdateBrowse"
                                   id="productFileUpdateBrowse" accept=".png,.jpg,.jpeg">
                            <label for="productFileUpdateBrowse" class="tower-file-button"> <span
                                        class="mdi mdi-upload"></span>Browse </label>
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
<div class="modal fade" id="productFileEditModal" tabindex="-1" role="dialog"
     aria-labelledby="productFileEditModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?= base_url('panel/product/ajax_product_file_description/' . $id . '/' . $lang) ?>"
                  method="post"
                  id="productFileEditModalForm">
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
                        <input type="text"
                               class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                               id="productFileTitle" placeholder="Title" name="productFileTitle" value="">
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
<div class="modal fade" id="deleteProductFileModal" tabindex="-1" role="dialog"
     aria-labelledby="deleteProductFileModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?= base_url('panel/product/ajax_delete_product_file/' . $id . '/' . $lang) ?>" method="post"
                  id="deleteProductFileModalForm">
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
<div class="modal fade" id="productVariantAddModal" tabindex="-1" role="dialog"
     aria-labelledby="productVariantAddModalTitle" aria-hidden="true">
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