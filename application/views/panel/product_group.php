<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Groups</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>                       
                        <li class="breadcrumb-item active">Groups</li>
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
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Groups</h4>
                            <?php if ($controller_config['disable_add_pr_group'] !== TRUE): ?>
                                <a href="<?= site_url('panel/product_group/add') ?>" class="btn btn-sm btn-info float-right"
                                   title="Add"><i class="fas fa-user-plus"></i> Add</a>
                               <?php endif; ?>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="<?= site_url('panel/product_group/all') ?>"
                              enctype="multipart/form-data" id="articleForm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="10%">Sl.No.</th>
                                                    <th width="70%">Title</th>
                                                    <?php if ($controller_config['disable_delete_pr_group_order'] != TRUE): ?>
                                                        <th width="10%">Order</th>
                                                    <?php endif; ?>
                                                    <th width="10%">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>											
                                                <?php if ($group_items): ?>
                                                    <?= $group_items ?><?php else: ?>
                                                    <tr>
                                                        <td colspan="4" align="center">No records available</td>
                                                    </tr>
                                                <?php endif; ?>
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
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div><!-- /.content-wrapper -->