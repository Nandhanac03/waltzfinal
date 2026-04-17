<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Attribute: <?= $attribute->title ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/product_attribute/all') ?>">attribute</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Value</li>
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
                            <h3 class="card-title">Edit Value</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post"
                              action="<?= site_url('panel/product_attribute/edit_value/' . $attribute->id . '/' . $parent_attribute_value->id . '/' . $current_language->id) ?>"
                              enctype="multipart/form-data" id="menuForm">
                            <div class="card-body">
                                <div class="row">									
                                    <?php if ($languages && count($languages) > 1 && $controller_config['disable_attr_value_languages'] != TRUE): ?>
                                        <div class="col-sm-12">										
                                            <ul class="nav nav-tabs mb-4" id="news-content-below-tab" role="tablist">
                                                <?php
                                                $i = 1;
                                                foreach ($languages as $language):
                                                    ?>
                                                    <li class="nav-item">
                                                        <a class="nav-link <?= in_array($language->id, $value_languages) && $language->id != $current_language->id ? ' bg-navy' : '' ?><?= $language->id == $current_language->id ? ' active bg-success' : '' ?>"
                                                           href="<?= base_url('panel/product_attribute/edit_value/' . $attribute->id . '/' . $parent_attribute_value->id . '/' . $language->id) ?>"
                                                           role="tab" aria-selected="true"><?= $language->name ?></a>
                                                    </li>
                                                    <?php
                                                endforeach;
                                                ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group col-sm-12">
                                        <label for="attributeValue">Value <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="attributeValue" placeholder="Title"
                                               name="attributeValue"
                                               value="<?= set_value('attributeValue', !empty($attribute_value->attribute_value) ? $attribute_value->attribute_value : '') ?>">
                                               <?php echo form_error('attributeValue'); ?>
                                    </div>
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