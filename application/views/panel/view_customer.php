<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Customer</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/customer/all') ?>">Customers</a></li>
                        <li class="breadcrumb-item active">Customer</li>
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
                            <h3 class="card-title">Customer</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="<?= site_url('panel/customer/edit/' . $customer->id) ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <label>Name</label>
                                        <p><?= $customer->full_name ?></p>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label>Email</label>
                                        <p><?= $customer->email ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Company</label>
                                        <p><?= $customer->company ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Username</label>
                                        <p><?= $customer->username ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Address</label>
                                        <p><?= $customer->address ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>P.O Box</label>
                                        <p><?= $customer->po_box ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Country</label>
                                        <p><?= $country->countryName ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Phone</label>
                                        <p><?= $customer->phone_country_code . ' ' . $customer->phone_no ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Fax</label>
                                        <p><?= $customer->fax_country_code . ' ' . $customer->fax_no ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Mobile</label>
                                        <p><?= $customer->mobile_country_code . ' ' . $customer->mobile_no ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Created At</label>
                                        <p><?= date('d-m-Y H:i', $customer->created_at) ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Status</label>
                                        <p><?= $customer->active == 1 ? 'Active' : 'Inactive' ?></p>
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