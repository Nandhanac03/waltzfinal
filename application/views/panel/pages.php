<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Content Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Content Management</li>
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
                            <h4 class="card-title">Content Management</h4>
                            <?php if ($controller_config['disable_page_add'] !== TRUE) : ?>
                                <a href="<?= site_url('panel/page/add') ?>" class="btn btn-sm btn-info float-right" title="Add"><i class="fas fa-user-plus"></i> Add</a>
                            <?php endif; ?>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" method="post" action="<?= site_url('panel/page/all') ?>">
                                <div class="row mt-2 mb-4">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="filterPageTitle" placeholder="Content Title" name="filterPageTitle" value="<?= set_value('filterPageTitle') ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control dateRangeTimePicker" id="filterPageCreatedAt" placeholder="Created At" name="filterPageCreatedAt" value="<?= set_value('filterPageCreatedAt') ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <select class="custom-select" id="filterPageMenu" name="filterPageMenu">
                                                <option value="">Select Page</option>
                                                <?php
                                                if ($menus) :
                                                    foreach ($menus as $menu_item) :
                                                ?>
                                                        <option value="<?= $menu_item->id ?>" <?= $menu_item->id == set_value('filterPageMenu') ? 'selected' : '' ?>><?= $menu_item->title ?></option>
                                                <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </select>
                                            <?php echo form_error('filterPageMenu'); ?>
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
                                        <th>Page</th>
                                        <th>Content</th>
                                        <!-- <th>Status</th> -->
                                        <th>Created At</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($pages) : $i = 0;
                                        foreach ($pages as $page) : $i++;
                                    ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $menu_array[$page->menu] ?></td>
                                                <td><?= htmlspecialchars($page->title, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <!-- <td><p class="bg-<?= htmlspecialchars($page->active == '1' ? 'success' : 'danger', ENT_QUOTES, 'UTF-8'); ?> p-1 text-center rounded"><?= htmlspecialchars($page->active == '1' ? 'Active' : 'Inactive', ENT_QUOTES, 'UTF-8'); ?></p></td> -->
                                                <td><?= htmlspecialchars(date('d-m-Y H:i', $page->created_at), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <a href="<?= site_url('panel/page/edit/' . $page->id . '/' . $page->language) ?>" title='Edit' class="btn-sm btn-primary"><i class="fas fa-user-edit"></i></a>
                                                    <?php if ($controller_config['disable_page_delete'] !== TRUE) : ?>
                                                    <!-- <a href="#" class="btn-sm btn-danger trigger_alert_modal" data-title="Confirm" data-desc="Are you sure want to delete this?" data-redirect="<?= site_url('panel/page/delete/' . $page->id) ?>" title='Delete'><i class="fas fa-trash-alt"></i></a>
                                                    <?php endif; ?> -->
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