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
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/product/all') ?>">Product Variant</a>
                        </li>
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
                <div class="col-sm-2">
                    <ul class="nav nav-tabs flex-column mb-4" id="product-content-below-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link <?= $active_menu_group == 'product' ? 'bg-info' : 'bg-gray-dark' ?>"
                               style="border-radius: 0;"
                               href="<?= base_url('panel/product/edit/' . $id) ?>"
                               role="tab" aria-selected="true">General</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= $active_menu_group == 'product_variant' ? 'bg-info' : 'bg-gray-dark' ?>"
                               style="border-radius: 0;"
                               href="<?= base_url('panel/product_variant/add/' . $id) ?>"
                               role="tab" aria-selected="true">Variant</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-10">
                    <?= $alert ?>
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Add</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- form start -->
                            <form role="form" method="post" action="<?= site_url('panel/product_variant/add/' . $id) ?>"
                                  enctype="multipart/form-data" id="productForm">
                                <?php if ($controller_config['disable_pr_sku'] !== TRUE): ?>
                                    <div class="form-group col-sm-12">
                                        <label for="productSKU">SKU</label>
                                        <input type="text"
                                               class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                               id="productSKU" placeholder="SKU" name="productSKU"
                                               value="<?= set_value('productSKU', empty($product->sku) ? '' : $product->sku) ?>">
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
                                             class="error-text"><?= $productCoverImgError ?></div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_pr_qty_per_unty'] !== TRUE): ?>
                                    <div class="form-group col-sm-12">
                                        <label for="productQuantityPerUnit">Quantity Per Unit</label>
                                        <input type="text"
                                               class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                               id="productQuantityPerUnit" placeholder="Quantity Per Unit"
                                               name="productQuantityPerUnit"
                                               value="<?= set_value('productQuantityPerUnit') ?>">
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
                                               value="<?= set_value('productUnitsInStock') ?>">
                                        <?php echo form_error('productUnitsInStock'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_pr_manufacturer_retail_price'] !== TRUE): ?>
                                    <div class="form-group col-sm-12">
                                        <label for="productManufacturerRetailPrice">Manufacturer Retail
                                            Price</label>
                                        <input type="text"
                                               class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                               id="productManufacturerRetailPrice"
                                               placeholder="Manufacturer Retail Price"
                                               name="productManufacturerRetailPrice"
                                               value="<?= set_value('productManufacturerRetailPrice') ?>">
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
                                               value="<?= set_value('productUnitPrice') ?>">
                                        <?php echo form_error('productUnitPrice'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_pr_discount'] != TRUE): ?>
                                    <div class="form-group col-sm-12">
                                        <label for="productDiscount">Discount</label>
                                        <input type="text"
                                               class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                               id="productDiscount" placeholder="Discount" name="productDiscount"
                                               value="<?= set_value('productDiscount') ?>">
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
                                               value="<?= set_value('productSellingPrice') ?>">
                                        <?php echo form_error('productSellingPrice'); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="col-sm-12 mt-4">
                                    <button type="submit" class="btn btn-success float-right">Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped data-table-search-off">
                                <thead>
                                <tr>
                                    <th>Sl.No.</th>
                                    <th width="20%">Attribute</th>
                                    <th>Units in stock</th>
                                    <th>Unit Price</th>
                                    <th>Discount</th>
                                    <th>Selling Price</th>
                                    <th>Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if ($all_variants): $i = 1; ?>
                                    <?php foreach ($all_variants as $variant): ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?php
                                                if ($variant->attributes) {
                                                    foreach ($variant->attributes as $variant_attribute) {
                                                        echo '<p>' . $variant_attribute['attribute'] . ' : ' . $variant_attribute['attribute_value'] . '</p>';
                                                    }
                                                }
                                                ?></td>
                                            <td><?= htmlspecialchars($variant->units_in_stock, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?= htmlspecialchars($variant->unit_price, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?= htmlspecialchars($variant->discount, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><?= htmlspecialchars($variant->selling_price, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td>
                                                <a href="<?= site_url('panel/product_variant/edit/' . $id . '/' . $variant->id . '/' . $product->language) ?>"
                                                   title='Edit' class="btn-sm btn-primary"><i
                                                            class="fas fa-user-edit"></i></a>
                                            </td>
                                        </tr>
                                        <?php $i++; endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
