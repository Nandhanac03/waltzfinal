<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Permission</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/permissions') ?>">Permissions</a></li>
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
                <div class="col-6 offset-md-3">
                    <?= $alert ?>
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Add</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="<?= site_url('panel/user/add_permission') ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="regPermissionKey">Key</label>
                                    <input type="text" class="form-control" id="regPermissionKey"
                                           name="regPermissionKey" placeholder="Key"
                                           value="<?= set_value('regPermissionKey') ?>">
                                           <?php echo form_error('regPermissionKey'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="regPermissionName">Name</label>
                                    <input type="text" class="form-control" id="regPermissionName"
                                           name="regPermissionName" placeholder="Name"
                                           value="<?= set_value('regPermissionName') ?>">
                                           <?php echo form_error('regPermissionName'); ?>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div><!-- /.content-wrapper -->