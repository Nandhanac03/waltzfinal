<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Quotation: <?= $quotation->quotation_ref_no ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Quotation</li>
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
                            <h4 class="card-title">Quotation: <?= $quotation->quotation_ref_no ?></h4>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" method="post" action="<?= site_url('panel/product_quotation/view/' . $quotation->id) ?>">
                                <div class="row">
                                    <table class="table table-bordered table-stripped">
                                        <thead>
                                            <tr>
                                                <th colspan="2"><h3>Quotation Details</h3></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td width="25%"><label>Ref. No.</label></td>
                                                <td><?= $quotation->quotation_ref_no ?></td>
                                            </tr>
                                            <tr>
                                                <td width="25%"><label>Status</label></td>
                                                <td><?php
                                                    if ($quotation->quotation_status == 'F') {
                                                        echo 'Fulfilled';
                                                    } else if ($quotation->quotation_status == 'A') {
                                                        echo 'Approved';
                                                    } else if ($quotation->quotation_status == 'C') {
                                                        echo 'Cancelled';
                                                    } else {
                                                        echo 'Pending';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php if ($quotation->note): ?>
                                                <tr>
                                                    <td width="25%"><label>Note</label></td>
                                                    <td><?= $quotation->note ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>									
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="2"><h3>Customer Details</h3></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td width="25%"><label>First Name</label></td>
                                                <td><?= $profile->first_name ?></td>
                                            </tr>
                                            <tr>
                                                <td width="25%"><label>Last Name</label></td>
                                                <td><?= $profile->last_name ?></td>
                                            </tr>
                                            <tr>
                                                <td width="25%"><label>Address</label></td>
                                                <td><?= $profile->address ?></td>
                                            </tr>
                                            <?php if ($profile->city): ?>
                                                <tr>
                                                    <td width="25%"><label>City</label></td>
                                                    <td><?= $profile->city ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <?php if ($profile->state): ?>
                                                <tr>
                                                    <td width="25%"><label>State</label></td>
                                                    <td><?= $profile->state ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            <tr>
                                                <td width="25%"><label>Country</label></td>
                                                <td><?= $profile->country ?></td>
                                            </tr>
                                            <tr>
                                                <td width="25%"><label>Postal Code</label></td>
                                                <td><?= $profile->po_box ?></td>
                                            </tr>
                                            <tr>
                                                <td width="25%"><label>Email</label></td>
                                                <td><?= $profile->email ?></td>
                                            </tr>
                                            <tr>
                                                <td width="25%"><label>Phone</label></td>
                                                <td><?= $profile->phone ?></td>
                                            </tr>
                                            <?php if ($profile->fax): ?>
                                                <tr>
                                                    <td width="25%"><label>Fax</label></td>
                                                    <td><?= $profile->fax ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>									
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="7"><h3>Quotation Review</h3></th>
                                            </tr>
                                            <tr>
                                                <th>Sl.No.</th>
                                                <th width="40%">Product</th>
                                                <th>Code</th>
                                                <th>Availability</th>
                                                <th>Unit Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?= $product_quotation_items ?>										
                                        </tbody>
                                    </table>									
                                    <div class="col-sm-12">
                                        <div class="form-group col-sm-5">
                                            <label for="quotationNote">Note</label>
                                            <textarea class="form-control" id="quotationNote" placeholder="Note"
                                                      name="quotationNote" value="<?= set_value('quotationNote') ?>"></textarea>
                                                      <?php echo form_error('quotationNote'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group col-sm-2">
                                            <label for="quotationStatus">Quotation Status</label>
                                            <select class="custom-select" id="quotationStatus" name="quotationStatus">
                                                <option value="P" <?= $quotation->quotation_status == 'P' ? 'selected' : '' ?>>
                                                    Pending
                                                </option>
                                                <option value="A" <?= $quotation->quotation_status == 'A' ? 'selected' : '' ?>>
                                                    Approved
                                                </option>
                                                <option value="F" <?= $quotation->quotation_status == 'F' ? 'selected' : '' ?>>
                                                    Fulfilled
                                                </option>
                                                <option value="C" <?= $quotation->quotation_status == 'C' ? 'selected' : '' ?>>
                                                    Cancelled
                                                </option>
                                            </select>
                                            <?php echo form_error('quotationStatus'); ?>
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