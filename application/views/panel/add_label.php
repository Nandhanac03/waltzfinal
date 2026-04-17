<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Label</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/label/all') ?>">Label</a></li>
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
                        <form role="form" method="post" action="<?= site_url('panel/label/add') ?>"
                              enctype="multipart/form-data" id="labelForm">
                            <div class="card-body">
                                <div class="row">
                                    <?php if ($controller_config['disable_label_parent'] != TRUE): ?>
                                        <div class="form-group col-sm-12 col-md-4">
                                            <label for="parentLabel">Parent Label</label>
                                            <select class="custom-select" id="parentLabel" name="parentLabel">
                                                <option value="">None</option>
                                                <?php
                                                if ($labels):
                                                    foreach ($labels as $label_item):
                                                        ?>
                                                        <option value="<?= $label_item->id ?>"><?= $label_item->title ?></option>
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </select>
                                            <?php echo form_error('parentLabel'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group col-sm-12">
                                        <label for="labelTitle">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="labelTitle" placeholder="Title"
                                               name="labelTitle" value="<?= set_value('labelTitle') ?>" onchange="str_to_underscore(this,'labelKeyword')">
                                               <?php echo form_error('labelTitle'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_label_keyword'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="labelKeyword">Keyword <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="labelKeyword" placeholder="Title"
                                                   name="labelKeyword" value="<?= set_value('labelKeyword') ?>">
                                                   <?php echo form_error('labelKeyword'); ?>
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