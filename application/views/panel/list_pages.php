<!-- Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


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
                        <li class="breadcrumb-item active">Listing</li>
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
                            <?php if ($controller_config['disable_page_list'] !== TRUE) : ?>
                                <a href="<?= site_url('panel/page/all') ?>" class="btn btn-sm btn-info float-right d-flex align-items-center" title="Add"><i class="bi bi-card-list me-1 fs-5"></i><span>CMS Listing</span></a>
                            <?php endif; ?>
                            <?php if ($controller_config['disable_page_add'] !== TRUE) : ?>
                                <a href="<?= site_url('panel/page/add') ?>" class="btn btn-md btn-success float-right me-4" title="Add"><i class="fas fa-user-plus"></i> Add</a>
                            <?php endif; ?>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="accordion accordion-flush" id="accordianMenus">
                                <?php if ($menus) {
                                    foreach ($menus as $key => $menu) {
                                ?>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $key ?>" aria-expanded="false" aria-controls="flush-collapse<?= $key ?>">
                                                    <?= $menu->title ?>
                                                </button>
                                            </h2>
                                            <div id="flush-collapse<?= $key ?>" class="accordion-collapse collapse <?php if ($key == 0) {
                                                                                                                        echo "show";
                                                                                                                    } ?>" data-bs-parent="#accordianMenus">
                                                <div class="accordion-body">
                                                    <?php if ($pages) {
                                                        foreach ($pages as $page) {
                                                            if ($menu->id === $page->menu) { ?>
                                                                <a class="btn btn-outline-primary mb-2" href="<?= site_url('panel/page/edit/' . $page->id . '/' . $page->language) ?>"><?= $page->title ?></a>
                                                    <?php }
                                                        }
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div><!-- /.content-wrapper -->