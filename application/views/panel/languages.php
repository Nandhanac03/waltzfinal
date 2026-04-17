<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Languages</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Languages</li>
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
                            <h4 class="card-title">Languages</h4>
                            <a href="<?= site_url('panel/language/add') ?>" class="btn btn-sm btn-info float-right"
                               title="Add"><i class="fas fa-user-plus"></i> Add Language</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped data-table">
                                <thead>
                                    <tr>
                                        <th>Sl.No.</th>
                                        <th>Language</th>
                                        <th>Code</th>
                                        <th>Status</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($languages):$i = 0;
                                        foreach ($languages as $language): $i++;
                                            ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= htmlspecialchars($language->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?= htmlspecialchars($language->code, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?= ($language->status) ? '<label class="bg-success rounded p-1">Active</label>' : '<label class="bg-danger rounded p-1">Inactive</label>'; ?></td>
                                                <td><a href="<?= site_url('panel/language/edit/' . $language->id) ?>"
                                                       title='Edit' class="btn-sm btn-success"><i
                                                            class="fas fa-edit"></i></a> <a
                                                        href="<?= site_url('panel/language/view/' . $language->id) ?>"
                                                        title='View' class="btn-sm btn-dark"><i class="fas fa-eye"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        endforeach;
                                    else:
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