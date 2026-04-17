<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Social Media</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Social Media</li>
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
                            <h4 class="card-title">Social Media</h4>
                            <?php if ($controller_config['disable_socialmedia_add'] != true) : ?>
                                <a href="<?= site_url('panel/socialmedia/add') ?>" class="btn btn-sm btn-info float-right" title="Add"><i class="fas fa-user-plus"></i> Add</a>
                            <?php endif; ?>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped data-table">
                                <thead>
                                    <tr>
                                        <th>Sl.No.</th>
                                        <th>Social Media</th>
                                        <th>Url</th>
                                        <th>Status</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($socialmedias) : $i = 0;
                                        foreach ($socialmedias as $socialmedia) : $i++;
                                    ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $socialmedia->name ?></td>
                                                <td><?= htmlspecialchars($socialmedia->url, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <span class="badge badge-<?= htmlspecialchars($socialmedia->status == '1' ? 'success' : 'danger', ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars($socialmedia->status == '1' ? 'Active' : 'Inactive', ENT_QUOTES, 'UTF-8'); ?></span>
                                                </td>
                                                <td><a href="<?= site_url('panel/socialmedia/edit/' . $socialmedia->id) ?>" title='Edit' class="btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                                </td>
                                            </tr>
                                        <?php
                                        endforeach;
                                    else :
                                        ?>
                                        <tr>
                                            <td colspan="5" class="text-center">No records found</td>
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