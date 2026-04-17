<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Inquiry</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/product_inquiry/all') ?>">Inquiries</a></li>
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
                            <h3 class="card-title">Inquiry</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="<?= site_url('panel/product_inquiry/view/' . $inquiry->id) ?>"
                              enctype="multipart/form-data" id="inquiryForm">
                            <div class="card-body">								
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Customer</label>
                                        <p>Name: <?= $inquiry->name ?><br/>										
                                            Email: <?= $inquiry->email ?><br/>										
                                            Phone: <?= $inquiry->phone ?></p>										
                                    </div>	
                                    <div class=" col-sm-12">
                                        <label>Subject</label>
                                        <p><?= $inquiry->title ?></p>
                                    </div>																		
                                    <div class="col-sm-12">
                                        <label>Description</label>
                                        <p><?= $inquiry->description ?></p>										
                                    </div>	
                                    <div class="col-sm-12">
                                        <label>Products</label>
                                        <p>
                                            <?php if ($inquiry_products): $i = 1; ?>
                                                <?php foreach ($inquiry_products as $inquiry_product): ?>
                                                    <a href="<?= base_url('product/info/' . $inquiry_product->id) ?>"  target="_blank"><?= $i ?>. <?= $inquiry_product->product_name ?></a><br/>
                                                    <?php
                                                    $i++;
                                                endforeach;
                                                ?>
                                            <?php endif; ?>
                                        </p>										
                                    </div>                           
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div><!-- /.content-wrapper -->