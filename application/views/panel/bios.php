<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Services</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Services</li>
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
                            <h4 class="card-title">Services</h4>
                            <!-- <a href="<?= site_url('panel/bio/add') ?>" class="btn btn-sm btn-info float-right"
                               title="Add"><i class="fas fa-user-plus"></i> Add</a> -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" method="post" action="<?= site_url('panel/bio/all') ?>">
                                <div class="row mt-2 mb-4">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control dateRangeTimePicker"
                                                id="filterBioCreatedAt" placeholder="Created At"
                                                name="filterBioCreatedAt"
                                                value="<?= set_value('filterBioCreatedAt') ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="filterBioTitle"
                                                placeholder="Title" name="filterBioTitle"
                                                value="<?= set_value('filterBioTitle') ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary float-left">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-bordered table-striped data-table-search-off">
                                <thead>
                                    <tr>
                                        <th>Sl.No.</th>
                                        <th>Name</th>
                                        <?php if ($controller_config['disable_bio_person_is'] != TRUE): ?>
                                            <th>Type</th>
                                        <?php endif; ?>
                                        <th>Created At</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($bios): $i = 0;
                                        foreach ($bios as $bio): $i++;
                                    ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= htmlspecialchars($bio->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <?php if ($controller_config['disable_bio_person_is'] != TRUE): ?>
                                                    <td><?= $bio->person_is == 'A' ? 'Author' : 'Illustrator'; ?></td>
                                                <?php endif; ?>
                                                <td><?= htmlspecialchars(date('d-m-Y H:i', $bio->created_at), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <a href="<?= site_url('panel/bio/edit/' . $bio->id . '/' . $bio->language) ?>"
                                                        title='Edit' class="btn-sm btn-primary"><i
                                                            class="fas fa-user-edit"></i></a>
                                                    <!-- <a href="#"
                                                        class="btn-sm btn-danger trigger_alert_modal"
                                                        data-title="Confirm"
                                                        data-desc="Are you sure want to delete this?"
                                                        data-redirect="<?= site_url('panel/bio/delete/' . $bio->id) ?>"
                                                        title='Delete'><i
                                                            class="fas fa-trash-alt"></i></a> -->
                                                </td>
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