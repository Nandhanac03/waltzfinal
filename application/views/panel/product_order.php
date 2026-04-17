<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Orders</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Orders</li>
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
                            <h4 class="card-title">Orders</h4>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" method="post" action="<?= site_url('panel/product_order/all') ?>">
                                <div class="row mt-2 mb-4">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <select class="custom-select" id="filterPaymentStatus" name="filterPaymentStatus">
                                                <option value="">Payment Status</option>
                                                <option value="P" <?= set_value('filterPaymentStatus') == 'P' ? 'selected' : '' ?>>
                                                    Pending
                                                </option>
                                                <option value="S" <?= set_value('filterPaymentStatus') == 'S' ? 'selected' : '' ?>>
                                                    Successful
                                                </option>
                                                <option value="F" <?= set_value('filterPaymentStatus') == 'F' ? 'selected' : '' ?>>
                                                    Failed
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <select class="custom-select" id="filterOrderStatus" name="filterOrderStatus">
                                                <option value="">Order Status</option>
                                                <option value="D" <?= set_value('filterOrderStatus') == 'D' ? 'selected' : '' ?>>
                                                    Delivered
                                                </option>
                                                <option value="S" <?= set_value('filterOrderStatus') == 'S' ? 'selected' : '' ?>>
                                                    Shipped
                                                </option>
                                                <option value="C" <?= set_value('filterOrderStatus') == 'C' ? 'selected' : '' ?>>
                                                    Cancelled
                                                </option>
                                                <option value="P" <?= set_value('filterOrderStatus') == 'P' ? 'selected' : '' ?>>
                                                    Pending
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="filterOrderRefNo" placeholder="Order Ref. No." name="filterOrderRefNo" value="<?= set_value('filterOrderRefNo') ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control dateRangeTimePicker" id="filterOrderedAt" placeholder="Created At" name="filterOrderedAt" value="<?= set_value('filterOrderedAt') ?>">
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
                                        <th>Ref. No.</th>
                                        <th>Bill To</th>
                                        <th>Grand Total</th>
                                        <th>Order Status</th>
                                        <th>Payment Status</th>
                                        <th>Ordered At</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($orders) : $i = 0;
                                        foreach ($orders as $order) : $i++;
                                    ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= htmlspecialchars($order->order_ref_no, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?= htmlspecialchars($order->billing_first_name . ' ' . $order->billing_last_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?= htmlspecialchars($order->grand_total, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <?php
                                                    if ($order->order_status == 'D') {
                                                        echo 'Delivered';
                                                    } else  if ($order->order_status == 'S') {
                                                        echo 'Shipped';
                                                    } else if ($order->order_status == 'C') {
                                                        echo 'Cancelled';
                                                    } else {
                                                        echo 'Pending';
                                                    }
                                                    if ($order->direct_order == 1) {
                                                        echo '<br/><small><b>Direct Order</b></small>';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($order->payment_status == 'S') {
                                                        echo 'Successful';
                                                    } else if ($order->payment_status == 'F') {
                                                        echo 'Failed';
                                                    } else {
                                                        echo 'Pending';
                                                    }
                                                    ?>
                                                </td>
                                                <td><?= htmlspecialchars(date('d-m-Y H:i', $order->created_at), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <a href="<?= site_url('panel/product_order/view/' . $order->id) ?>" title='View' class="btn-sm btn-success"><i class="fas fa-eye"></i></a>
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