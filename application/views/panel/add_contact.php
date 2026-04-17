<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Contact</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/contact/all') ?>">Contact</a></li>
                        <li class="breadcrumb-item active">Add</li>
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
                            <h3 class="card-title">Add</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="<?= site_url('panel/contact/add') ?>"
                              enctype="multipart/form-data" id="contactForm">
                            <div class="card-body">
                                <div class="row">
                                    <?php if ($controller_config['disable_contact_name'] != true): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="contactTitle">Name</label>
                                            <input type="text"
                                                   class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                   id="contactName" placeholder="Name" name="contactName"
                                                   value="<?= set_value('contactName') ?>">
                                                   <?php echo form_error('contactName'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_contact_address'] != true): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="contactAddress">Address</label>
                                            <textarea class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                      id="contactAddress" 
                                                      placeholder="Address"
                                                      name="contactAddress"><?= set_value('contactAddress') ?></textarea>
                                                      <?php echo form_error('contactAddress'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_contact_email'] != true): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="contactEmail">Email</label>
                                            <textarea class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                      id="contactEmail"
                                                      placeholder="Email"
                                                      name="contactEmail"><?= set_value('contactEmail') ?></textarea>
                                                      <?php echo form_error('contactEmail'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_contact_phone'] != true): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="contactPhone">Phone</label>
                                            <textarea class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                      id="contactPhone"
                                                      placeholder="Phone"
                                                      name="contactPhone"><?= set_value('contactPhone') ?></textarea>
                                                      <?php echo form_error('contactPhone'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_contact_fax'] != true): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="contactFax">Fax</label>
                                            <textarea class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                      id="contactFax" 
                                                      placeholder="Fax"
                                                      name="contactFax"><?= set_value('contactFax') ?></textarea>
                                                      <?php echo form_error('contactFax'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_contact_working_hours'] != true): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="contactWorkHour">Working Hours</label>
                                            <textarea class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                      id="contactWorkHour" 
                                                      placeholder="Working Hours"
                                                      name="contactWorkHour"><?= set_value('contactWorkHour') ?></textarea>
                                                      <?php echo form_error('contactWorkHour'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_contact_map'] != true): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="contactMap">Map</label>
                                            <textarea class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                      id="contactMap"
                                                      placeholder="Map"
                                                      name="contactMap"><?= set_value('contactMap') ?></textarea>
                                                      <?php echo form_error('contactMap'); ?>
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