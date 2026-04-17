<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Order: <?= $order->order_ref_no ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Order</li>
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
                            <h4 class="card-title">Order: <?= $order->order_ref_no ?></h4>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" method="post" action="<?= site_url('panel/product_order/view/' . $order->id) ?>">
                                <div class="row">
                                    <table class="table table-bordered table-stripped">
                                        <thead>
                                            <tr>
                                                <th colspan="2">
                                                    <h3>Order Details</h3>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td width="25%"><label>Ref. No.</label></td>
                                                <td><?= $order->order_ref_no ?></td>
                                            </tr>
                                            <tr>
                                                <td width="25%"><label>Status</label></td>
                                                <td><?php
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
                                            </tr>
                                            <?php if ($order->note) : ?>
                                                <tr>
                                                    <td width="25%"><label>Note</label></td>
                                                    <td><?= $order->note ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="2">
                                                    <h3>Billing Address</h3>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($order->billing_first_name) : ?>
                                                <tr>
                                                    <td width="25%"><label>First Name</label></td>
                                                    <td><?= $order->billing_first_name ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if ($order->billing_last_name) : ?>
                                                <tr>
                                                    <td width="25%"><label>Last Name</label></td>
                                                    <td><?= $order->billing_last_name ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if ($order->billing_address) : ?>
                                                <tr>
                                                    <td width="25%"><label>Address</label></td>
                                                    <td><?= $order->billing_address ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if ($order->billing_city) : ?>
                                                <tr>
                                                    <td width="25%"><label>City</label></td>
                                                    <td><?= $order->billing_city ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if ($order->billing_state) : ?>
                                                <tr>
                                                    <td width="25%"><label>State</label></td>
                                                    <td><?= $order->billing_state ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if ($order->billing_country) : ?>
                                                <tr>
                                                    <td width="25%"><label>Country</label></td>
                                                    <td><?= $order->billing_country ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if ($order->billing_postal_code) : ?>
                                                <tr>
                                                    <td width="25%"><label>Postal Code</label></td>
                                                    <td><?= $order->billing_postal_code ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if ($order->billing_email) : ?>
                                                <tr>
                                                    <td width="25%"><label>Email</label></td>
                                                    <td><?= $order->billing_email ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if ($order->billing_phone) : ?>
                                                <tr>
                                                    <td width="25%"><label>Phone</label></td>
                                                    <td><?= $order->billing_phone ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if ($order->billing_fax) : ?>
                                                <tr>
                                                    <td width="25%"><label>Fax</label></td>
                                                    <td><?= $order->billing_fax ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="2">
                                                    <h3>Shipping Address</h3>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($order->shipping_first_name) : ?>
                                                <tr>
                                                    <td width="25%"><label>First Name</label></td>
                                                    <td><?= $order->shipping_first_name ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if ($order->shipping_last_name) : ?>
                                                <tr>
                                                    <td width="25%"><label>Last Name</label></td>
                                                    <td><?= $order->shipping_last_name ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if ($order->shipping_address) : ?>
                                                <tr>
                                                    <td width="25%"><label>Address</label></td>
                                                    <td><?= $order->shipping_address ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if ($order->shipping_city) : ?>
                                                <tr>
                                                    <td width="25%"><label>City</label></td>
                                                    <td><?= $order->shipping_city ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if ($order->shipping_state) : ?>
                                                <tr>
                                                    <td width="25%"><label>State</label></td>
                                                    <td><?= $order->shipping_state ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if ($order->shipping_country) : ?>
                                                <tr>
                                                    <td width="25%"><label>Country</label></td>
                                                    <td><?= $order->shipping_country ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if ($order->shipping_postal_code) : ?>
                                                <tr>
                                                    <td width="25%"><label>Postal Code</label></td>
                                                    <td><?= $order->shipping_postal_code ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if ($order->shipping_email) : ?>
                                                <tr>
                                                    <td width="25%"><label>Email</label></td>
                                                    <td><?= $order->shipping_email ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if ($order->shipping_phone) : ?>
                                                <tr>
                                                    <td width="25%"><label>Phone</label></td>
                                                    <td><?= $order->shipping_phone ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if ($order->shipping_fax) : ?>
                                                <tr>
                                                    <td width="25%"><label>Fax</label></td>
                                                    <td><?= $order->shipping_fax ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if ($order->shipping_date) : ?>
                                                <tr>
                                                    <td width="25%"><label>Shipping Date</label></td>
                                                    <td><?= $order->shipping_date ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="6">
                                                    <h3>Order Review</h3>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Sl.No.</th>
                                                <th width="50%">Product</th>
                                                <th>Code</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?= $product_order_items ?>
                                            <tr>
                                                <td colspan="1"></td>
                                                <td colspan="2" align="right"><label>Sub Total</label></td>
                                                <td colspan="3" align="right"><?= config_item('CURRENCY') ?> <?= $order_payment->sub_total ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="1"></td>
                                                <td colspan="2" align="right"><label>Vat(<?= $order_payment->vat ?>%)</label></td>
                                                <td colspan="3" align="right"><?= config_item('CURRENCY') ?> <?= $order_payment->vat_amount ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="1"></td>
                                                <td colspan="2" align="right"><label>Shipping Charge</label></td>
                                                <td colspan="3" align="right"><?= config_item('CURRENCY') ?> <?= $order_payment->shipping_charge ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="1"></td>
                                                <td colspan="2" align="right"><label>Grand Total</label></td>
                                                <td colspan="3" align="right"><?= config_item('CURRENCY') ?> <?= $order_payment->grand_total ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="2">
                                                    <h3>Payment</h3>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td width="25%"><label>Payment Message</label></td>
                                                <td><?= $order_payment->payment_msg ?></td>
                                            </tr>
                                            <tr>
                                                <td width="25%"><label>Payment Status</label></td>
                                                <td>
                                                    <?php
                                                    if ($order_payment->payment_status == 'F') {
                                                        echo "Failed";
                                                    } else if ($order_payment->payment_status == 'S') {
                                                        echo "Successful";
                                                    } else {
                                                        echo "Pending";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="col-sm-12">
                                        <div class="form-group col-sm-5">
                                            <label for="orderNote">Note</label>
                                            <textarea class="form-control" id="orderNote" placeholder="Note" name="orderNote" value="<?= set_value('orderNote') ?>"></textarea>
                                            <?php echo form_error('orderNote'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group col-sm-2">
                                            <label for="paymentStatus">Payment Status</label>
                                            <select class="custom-select" id="paymentStatus" name="paymentStatus">
                                                <option value="P" <?= $order->payment_status == 'P' ? 'selected' : '' ?>>
                                                    Pending
                                                </option>
                                                <option value="S" <?= $order->payment_status == 'S' ? 'selected' : '' ?>>
                                                    Successful
                                                </option>
                                                <option value="F" <?= $order->payment_status == 'F' ? 'selected' : '' ?>>
                                                    Failed
                                                </option>
                                            </select>
                                            <?php echo form_error('orderStatus'); ?>
                                        </div>
                                    </div>
                                    <?php if ($order->payment_option > 0) : ?>
                                        <div class="col-sm-12">
                                            <div class="form-group col-sm-12">
                                                <label for="paymentOption">Payment Option</label>
                                                <?php if ($order->payment_option == 1) {
                                                    echo '<p>Cash on delivery</p>';
                                                } ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-sm-12">
                                        <div class="form-group col-sm-2">
                                            <label for="orderStatus">Order Status</label>
                                            <select class="custom-select" id="orderStatus" name="orderStatus">                                               
                                                <option value="D" <?= $order->order_status == 'D' ? 'selected' : '' ?>>
                                                    Delivered
                                                </option>
                                                <option value="S" <?= $order->order_status == 'S' ? 'selected' : '' ?>>
                                                    Shipped
                                                </option>
                                                <option value="C" <?= $order->order_status == 'C' ? 'selected' : '' ?>>
                                                    Cancelled
                                                </option>
                                                <option value="P" <?= $order->order_status == 'P' ? 'selected' : '' ?>>
                                                    Pending
                                                </option>
                                            </select>
                                            <?php echo form_error('orderStatus'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-4">
                                        <button type="submit" class="btn btn-success float-right">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div><!-- /.content-wrapper -->