<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Quotations</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Quotations</li>
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
                            <h4 class="card-title">Quotations</h4>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" method="post" action="<?= site_url('panel/product_quotation/all') ?>">
                                <div class="row mt-2 mb-4">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <select class="custom-select" id="filterQuotationStatus"
                                                    name="filterQuotationStatus">
                                                <option value="">Quotation Status</option>
                                                <option value="P" <?= set_value('filterPaymentStatus') == 'P' ? 'selected' : '' ?>>
                                                    Pending
                                                </option>
                                                <option value="A" <?= set_value('filterPaymentStatus') == 'A' ? 'selected' : '' ?>>
                                                    Approved
                                                </option>
                                                <option value="C" <?= set_value('filterPaymentStatus') == 'C' ? 'selected' : '' ?>>
                                                    Cancelled
                                                </option>
                                                <option value="F" <?= set_value('filterPaymentStatus') == 'F' ? 'selected' : '' ?>>
                                                    Fulfilled
                                                </option>
                                            </select>
                                        </div>
                                    </div>									
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="filterQuotationRefNo"
                                                   placeholder="Quotation Ref. No." name="filterQuotationRefNo"
                                                   value="<?= set_value('filterQuotationRefNo') ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control dateRangeTimePicker"
                                                   id="filterQuotationedAt" placeholder="Created At" name="filterQuotationedAt"
                                                   value="<?= set_value('filterQuotationedAt') ?>">
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
                                        <th>Customer</th>
                                        <th>Quotation Status</th>
                                        <th>Quotationed At</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($quotations): $i = 0;
                                        foreach ($quotations as $quotation): $i++;
                                            ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= htmlspecialchars($quotation->quotation_ref_no, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?= htmlspecialchars($quotation->first_name.' '.$quotation->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <?php
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
                                                <td><?= htmlspecialchars(date('d-m-Y H:i', $quotation->created_at), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <a href="<?= site_url('panel/product_quotation/view/' . $quotation->id) ?>"
                                                       title='View' class="btn-sm btn-success"><i
                                                            class="fas fa-eye"></i></a>
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