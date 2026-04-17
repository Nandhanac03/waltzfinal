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
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/user/groups') ?>">Groups</a></li>
                        <li class="breadcrumb-item active">Group</li>
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
                        <form role="form" method="post" action="<?= site_url('panel/user/add_group') ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="regGroupName">Group Name</label>
                                    <input type="text" class="form-control" id="regGroupName" placeholder="Group name"
                                           name="regGroupName" value="<?= set_value('regGroupName') ?>">
                                           <?php echo form_error('regGroupName'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="regGroupDesc">Group Description</label>
                                    <textarea rows="4" class="form-control" id="regGroupDesc" placeholder="Group Desc"
                                              name="regGroupDesc"><?= set_value('regGroupDesc') ?></textarea>
                                              <?php echo form_error('regGroupDesc'); ?>
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