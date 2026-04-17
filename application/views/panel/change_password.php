<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Change Password</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Change Password</li>
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
                            <h3 class="card-title">Change Password</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <?=$alert?>
                        <form role="form" method="post" action="<?= site_url('panel/user/change_password') ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="regPassword">Old Password</label>
                                    <input type="password" class="form-control" id="regOldPassword"
                                           name="regOldPassword" placeholder="Password">
                                           <?php echo form_error('regOldPassword'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="regPassword">Password</label>
                                    <input type="password" class="form-control" id="regPassword" name="regPassword"
                                           placeholder="Password">
                                           <?php echo form_error('regPassword'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="regConfirmPassword">Confirm Password</label>
                                    <input type="password" class="form-control" id="regConfirmPassword"
                                           name="regConfirmPassword" placeholder="Confirm Password">
                                           <?php echo form_error('regConfirmPassword'); ?>
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