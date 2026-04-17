<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Permissions</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Permissions</li>
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
                <div class="col-12">
                    <?= $alert ?>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Permissions</h4>
                            <a href="<?= site_url('panel/user/add_permission') ?>" class="btn btn-sm btn-info float-right"
                               title="Add"><i class="fas fa-plus"></i> Add</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped data-table">
                                <thead>
                                    <tr>
                                        <th>Sl.No.</th>
                                        <th>Name</th>
                                        <th>Key</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($permissions):$i = 0;
                                        foreach ($permissions as $permission):
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $permission['name'] ?></td>
                                                <td><?= $permission['key'] ?></td>
                                                <td><a href="<?= site_url('panel/user/edit_permission/' . $permission['id']) ?>"
                                                       title='Edit' class="btn-sm btn-success"><i
                                                            class="fas fa-edit"></i></a> <a href="#" title='Delete'
                                                                                    class="btn-sm btn-danger trigger_alert_modal"
                                                                                    data-redirect="<?= site_url('panel/user/delete_permission/' . $permission['id']) ?>"
                                                                                    data-title="Confirm"
                                                                                    data-desc="Are you sure want to delete this?"><i
                                                            class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        endforeach;
                                    else:
                                        ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No records found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div><!-- /.content-wrapper -->