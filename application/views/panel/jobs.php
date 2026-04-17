<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Careers</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Careers</li>
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
                            <h4 class="card-title">Careers</h4>
                            <?php if ($controller_config['disable_blog_add'] != TRUE) : ?>
                                <a href="<?= site_url('panel/jobs/add') ?>" class="btn btn-sm btn-info float-right" title="Add"><i class="fas fa-user-plus"></i> Add</a>
                            <?php endif; ?>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" method="post" action="<?= site_url('panel/jobs/all') ?>">
                                <div class="row mt-2 mb-4">
                                    <?php if ($controller_config['disable_news_type'] != TRUE) : ?>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <select class="custom-select" id="filterNewsType" name="filterNewsType">
                                                    <option value="">News Type</option>
                                                    <option value="N" <?= set_value('filterNewsType') == 'N' ? 'selected' : '' ?>>
                                                        Newsroom
                                                    </option>
                                                    <option value="M" <?= set_value('filterNewsType') == 'M' ? 'selected' : '' ?>>
                                                        Multimedia Newsroom
                                                    </option>
                                                    <option value="PV" <?= set_value('filterNewsType') == 'PV' ? 'selected' : '' ?>>
                                                        Press Video Newsroom
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_news_save_draft'] != TRUE) : ?>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <select class="custom-select" id="filterNewsStatus" name="filterNewsStatus">
                                                    <option value="">Career Status</option>
                                                    <option value="D" <?= set_value('filterNewsStatus') == 'D' ? 'selected' : '' ?>>
                                                        Closed
                                                    </option>
                                                    <option value="P" <?= set_value('filterNewsStatus') == 'P' ? 'selected' : '' ?>>
                                                        Open
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="filterNewsTitle" placeholder="Job Title" name="filterNewsTitle" value="<?= set_value('filterNewsTitle') ?>">
                                        </div>
                                    </div>
                                    <?php if ($controller_config['disable_news_published_at'] != TRUE) : ?>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control dateRangeTimePicker" id="filterNewsPublishedAt" placeholder="Created At" name="filterNewsPublishedAt" value="<?= set_value('filterNewsPublishedAt') ?>">
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control dateRangeTimePicker" id="filterNewsCreatedAt" placeholder="Created At" name="filterNewsCreatedAt" value="<?= set_value('filterNewsCreatedAt') ?>">
                                            </div>
                                        </div>
                                    <?php endif; ?>

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
                                        <th>Job Title</th>
                                        <th>Job Location</th>
                                        <th>Job Sector</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($jobs) : $i = 0;
                                        foreach ($jobs as $each_job) : $i++;
                                    ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= htmlspecialchars($each_job->title, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?= htmlspecialchars($each_job->location, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?= htmlspecialchars($each_job->sector, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?= htmlspecialchars(date('d-m-Y H:i', $each_job->created_at), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <span class="badge badge-<?= htmlspecialchars($each_job->active == '1' ? 'success' : 'danger', ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars($each_job->active == '1' ? 'Active' : 'Inactive', ENT_QUOTES, 'UTF-8'); ?></span>
                                                </td>
                                                <td>
                                                    <a href="<?= site_url('panel/jobs/edit/' . $each_job->id) ?>" title='Edit' class="btn-sm btn-primary"><i class="fas fa-user-edit"></i></a>
                                                    <a href="#" class="btn-sm btn-danger trigger_alert_modal" data-title="Confirm" data-desc="Are you sure want to delete this? <p class='text-danger'><i>(If you confirm, the item will be permanently removed from the server. The process cannot be reverted.)</i></p>" data-redirect="<?= site_url('panel/jobs/delete/' . $each_job->id) ?>" title='Delete'><i class="fas fa-trash-alt"></i></a>
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