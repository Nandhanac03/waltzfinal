<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Groups</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Groups</li>
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
                            <h4 class="card-title">Groups</h4>
                            <a href="<?= site_url('panel/user/add_group') ?>" class="btn btn-sm btn-info float-right"
                               title="Add"><i class="fas fa-plus"></i> Add</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped data-table">
                                <thead>
                                    <tr>
                                        <th>Sl.No.</th>
                                        <th>Group Name</th>
                                        <th>Group Description</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($groups): $i = 0;
                                        foreach ($groups as $group):
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $group['name'] ?></td>
                                                <td><?= $group['description'] ?></td>
                                                <td><a href="<?= site_url('panel/user/edit_group/' . $group['id']) ?>"
                                                       title='Edit' class="btn-sm btn-success"><i
                                                            class="fas fa-edit"></i></a> <a
                                                        href="<?= site_url('panel/user/group_permissions/' . $group['id']) ?>"
                                                        title='Permissions' class="btn-sm btn-dark"><i
                                                            class="fas fa-unlock-alt"></i></a></td>
                                            </tr>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
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