<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Attribute: <?= $attribute->title ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Attribute Values</li>
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
                            <h4 class="card-title">Attribute Values</h4>
                            <a href="<?= site_url('panel/product_attribute/add_value/' . $attribute->id) ?>"
                               class="btn btn-sm btn-info float-right" title="Add"><i class="fas fa-user-plus"></i> Add
                               </a>
                        </div>
                        <!-- /.card-header -->
                        <form role="form" method="post" action="<?= site_url('panel/product_attribute/all_value/' . $attribute->id) ?>"
                              enctype="multipart/form-data" id="articleForm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered table-striped data-table-search-off">
                                            <thead>
                                                <tr>
                                                    <th width="10%">Sl.No.</th>
                                                    <th>Title</th>
                                                    <?php if ($controller_config['disable_attr_value_order'] != TRUE): ?>
                                                        <th width="10%">Order</th>
                                                    <?php endif; ?>
                                                    <th width="15%">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?= $value_items ?>
                                            </tbody>
                                        </table>								
                                    </div>	
                                    <div class="col-sm-12 mt-4">
                                        <button type="submit" class="btn btn-success float-right">Save</button>
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