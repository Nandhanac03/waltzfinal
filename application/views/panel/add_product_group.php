<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Group</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/group/all') ?>">Group</a></li>
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
                        <form role="form" method="post" action="<?= site_url('panel/product_group/add') ?>"
                              enctype="multipart/form-data" id="groupForm">
                            <div class="card-body">
                                <div class="row">
                                    <?php if ($controller_config['disable_parent_pr_group'] != TRUE): ?>
                                        <div class="form-group col-sm-12 col-md-4">
                                            <label for="parentGroup">Parent Group</label>
                                            <select class="custom-select" id="parentGroup" name="parentGroup">
                                                <option value="">None</option>
                                                <?php
                                                if ($groups):
                                                    foreach ($groups as $group_item):
                                                        ?>
                                                        <option value="<?= $group_item->id ?>"><?= $group_item->title ?></option>
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </select>
                                            <?php echo form_error('parentGroup'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group col-sm-12">
                                        <label for="groupTitle">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="groupTitle" placeholder="Title"
                                               name="groupTitle" value="<?= set_value('groupTitle') ?>">
                                               <?php echo form_error('groupTitle'); ?>
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