<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">solution</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">solution</li>
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
                            <h4 class="card-title">solution</h4>
                            <a href="<?= site_url('panel/solution/add') ?>" class="btn btn-sm btn-info float-right" title="Add"><i class="fas fa-user-plus"></i> Add</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" method="post" action="<?= site_url('panel/solution/all') ?>">
                                <div class="row mt-2 mb-4">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="filtersolutionTitle" placeholder="solution Name" name="filtersolutionTitle" value="<?= set_value('filtersolutionTitle') ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control dateRangeTimePicker" id="filtersolutionCreatedAt" placeholder="Created At" name="filtersolutionCreatedAt" value="<?= set_value('filtersolutionCreatedAt') ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <select class="custom-select" id="filtersolutiontatus" name="filtersolutiontatus">
                                                <option value="">Select solution Status</option>
                                                <option value='Y' <?= set_value('filtersolutiontatus') == 'Y' ? 'selected' : '' ?>>Active</option>
                                                <option value='N' <?= set_value('filtersolutiontatus') == 'N' ? 'selected' : '' ?>>Inactive</option>
                                            </select>
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
                                        <th>solution Image</th>
                                        <th>solution Name</th>
                                        <th>Status</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($solutions) : $i = 0;
                                        foreach ($solutions as $solution) : $i++;
                                    ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td>
                                                    <?php if ($solution->cover_img) { ?>
                                                        <img style="width:2.5rem;" src="<?= base_url('assets/uploads/solution/') . htmlspecialchars($solution->cover_img, ENT_QUOTES, 'UTF-8'); ?> ">
                                                    <?php } else { ?>
                                                        <img style="width:2.5rem;" src="<?= base_url('assets/panel/dist/img/album_cover.jpg')  ?> ">
                                                    <?php } ?>
                                                </td>
                                                <td><?= htmlspecialchars($solution->title, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <span class="badge badge-<?= htmlspecialchars($solution->active == '1' ? 'success' : 'danger', ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars($solution->active == '1' ? 'Active' : 'Inactive', ENT_QUOTES, 'UTF-8'); ?></span>
                                                </td>
                                                <td>
                                                    <a href="<?= site_url('panel/solution/edit/' . $solution->id . '/' . $solution->language) ?>" title='Edit' class="btn-sm btn-primary"><i class="fas fa-user-edit"></i></a>
                                                    <a href="#" class="btn-sm btn-danger trigger_alert_modal" data-title="Confirm" data-desc="Are you sure want to delete this? <p class='text-danger'><i>(If you confirm, the item will be permanently removed from the server. The process cannot be reverted.)</i></p>" data-redirect="<?= site_url('panel/solution/delete_solution/' . $solution->id) ?>" title='Delete'><i class="fas fa-trash-alt"></i></a>
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