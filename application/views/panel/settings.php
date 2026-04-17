<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">General</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">General</li>
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
                            <h3 class="card-title">General</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="<?= site_url('panel/settings') ?>" enctype="multipart/form-data" id="contactForm">
                            <div class="card-body">
                                <div class="row">
                                    <?php if ($controller_config['disable_setting_vat'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="settingVat">VAT(%)</label>
                                            <input type="text" class="form-control" id="settingVat" placeholder="VAT" name="settingVat" value="<?= set_value('settingVat', $settings->vat) ?>">
                                            <?php echo form_error('settingVat'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_setting_contact_email'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="settingContactEmail">Email to which Website emails will be Sent</label>
                                            <input type="text" class="form-control" id="contactName" placeholder="Contact Email" name="settingContactEmail" value="<?= set_value('settingContactEmail', $settings->contact_email) ?>">
                                            <?php echo form_error('settingContactEmail'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_setting_order_email'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="settingOrderEmail">Order Email</label>
                                            <input type="text" class="form-control" id="settingOrderEmail" placeholder="Order Email" name="settingOrderEmail" value="<?= set_value('settingOrderEmail', $settings->order_email) ?>">
                                            <?php echo form_error('settingOrderEmail'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_setting_quotation_email'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="settingQuotationEmail">Quotation Email</label>
                                            <input type="text" class="form-control" id="settingQuotationEmail" placeholder="Quotation Email" name="settingQuotationEmail" value="<?= set_value('settingQuotationEmail', $settings->quotation_email) ?>">
                                            <?php echo form_error('settingQuotationEmail'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_setting_call_us'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="settingCallUs">Call Us</label>
                                            <input type="text" class="form-control" id="settingCallUs" placeholder="Phone No." name="settingCallUs" value="<?= set_value('settingCallUs', $settings->call_us) ?>">
                                            <?php echo form_error('settingCallUs'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_setting_copyright'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="copyRight">Copyright</label>
                                            <input type="text" class="form-control" id="copyRight" placeholder="Copy Right." name="copyRight" value="<?= set_value('copyRight', $settings->copyright) ?>">
                                            <?php echo form_error('copyRight'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_setting_shipping_charge'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="shippingCharge">Shipping Charge</label>
                                            <input type="text" class="form-control" id="shippingCharge" placeholder="Shipping Charge." name="shippingCharge" value="<?= set_value('shippingCharge', $shipping_charge->rate) ?>">
                                            <?php echo form_error('shippingCharge'); ?>
                                        </div>
                                    <?php endif; ?>
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