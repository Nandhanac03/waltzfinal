<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Language</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/language/all') ?>">Languages</a></li>
                        <li class="breadcrumb-item active">Language</li>
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
                <div class="col-sm-12">
                    <?= $alert ?>
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Language</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="<?= site_url('panel/language/edit/' . $language->id) ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label>Language</label>
                                        <p><?= ucwords($language->name) ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Code</label>
                                        <p><?= $language->code ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Created At</label>
                                        <p><?= date('d-m-Y H:i:s', strtotime($language->created_at)) ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Status</label>
                                        <p><?= $language->status == 1 ? 'Active' : 'Inactive' ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Flag</label>
                                        <p>
                                            <?php if (file_exists(FCPATH . 'assets/uploads/flag/' . $language->flag) && $language->flag != '') { ?>
                                                <img src="<?= base_url('assets/uploads/flag/' . $language->flag) ?>">
                                                <?php
                                            } else {
                                                echo "-";
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div><!-- /.content-wrapper -->