<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Attribute</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/product_attribute/all') ?>">Attribute</a>
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
                <div class="col-sm-12">
                    <?= $alert ?>
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Add</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="<?= site_url('panel/product_attribute/add') ?>"
                              enctype="multipart/form-data" id="attributeForm">
                            <div class="card-body">
                                <div class="row">
                                    <?php if ($controller_config['disable_parent_attribute'] != TRUE): ?>
                                        <div class="form-group col-sm-12 col-md-4">
                                            <label for="parentAttribute">Parent Attribute</label>
                                            <select class="custom-select" id="parentAttribute" name="parentAttribute">
                                                <option value="">None</option>
                                                <?php
                                                if ($attributes):
                                                    foreach ($attributes as $attribute_item):
                                                        ?>
                                                        <option value="<?= $attribute_item->id ?>"><?= $attribute_item->title ?></option>
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </select>
                                            <?php echo form_error('parentAttribute'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group col-sm-12">
                                        <label for="attributeTitle">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="attributeTitle" placeholder="Title"
                                               name="attributeTitle" value="<?= set_value('attributeTitle') ?>">
                                               <?php echo form_error('attributeTitle'); ?>
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