<style>
    .dashboard-wrapper {
        /* background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('<?= base_url('assets/web/img/about/cn1.jpg') ?>'); */
        background-size: cover;
        height: 80vh;
        background-position: center;
    }

    .card-body {
        height: 70vh;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    /* .card-body img {
        height: 75vh;
        width: 100%;
        object-fit: contain;
    } */
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper dashboard-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark ">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a class="fw-bold" href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active  text-dark">Dashboard</li>
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
                    <div class="card">

                        <div class="card-body bg-light">
                            <img src="<?= base_url('assets/panel/dist/img/logo.png') ?>" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div><!-- /.content-wrapper -->