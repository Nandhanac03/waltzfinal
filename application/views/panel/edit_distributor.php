<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Distributor</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/distributor/all') ?>">Distributor</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
                            <h3 class="card-title">Edit</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="<?= site_url('panel/distributor/edit/' . $id . '/' . $lang) ?>"
                              enctype="multipart/form-data" id="distributorForm">
                            <div class="card-body">
                                <?php if ($languages && count($languages) > 1 && $controller_config['disable_distributor_languages'] != TRUE): ?>
                                    <ul class="nav nav-tabs mb-4" id="news-content-below-tab" role="tablist">
                                        <?php
                                        $i = 1;
                                        foreach ($languages as $language):
                                            ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?= in_array($language->id, $distributor_languages) && $language->id != $lang ? ' bg-navy' : '' ?><?= $language->id == $lang ? ' active bg-success' : '' ?>"
                                                   href="<?= base_url('panel/distributor/edit/' . $id . '/' . $language->id) ?>"
                                                   role="tab" aria-selected="true"><?= $language->name ?></a>
                                            </li>
                                            <?php
                                        endforeach;
                                        ?>
                                    </ul>
                                <?php endif; ?>                                
                                <div class="row">
                                    <?php if ($controller_config['disable_distributor_name'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="distributorTitle">Name</label>
                                            <input type="text"
                                                   class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                   id="distributorName" placeholder="Name" name="distributorName"
                                                   value="<?= set_value('distributorName', empty($distributor->full_name) ? '' : $distributor->full_name) ?>">
                                                   <?php echo form_error('distributorName'); ?>
                                        </div>
                                    <?php endif; ?>  
                                    <?php if ($controller_config['disable_distributor_address'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="distributorAddress">Address</label>
                                            <textarea class="form-control"
                                                      id="distributorAddress" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?>
                                                      placeholder="Address"
                                                      name="distributorAddress"><?= set_value('distributorAddress', empty($distributor->address) ? '' : $distributor->address) ?></textarea>
                                                      <?php echo form_error('distributorAddress'); ?>
                                        </div>
                                    <?php endif; ?>  
                                    <?php if ($controller_config['disable_distributor_email'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="distributorEmail">Email</label>
                                            <textarea class="form-control"
                                                      id="distributorEmail" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?>
                                                      placeholder="Email"
                                                      name="distributorEmail"><?= set_value('distributorEmail', empty($distributor->email) ? '' : $distributor->email) ?></textarea>
                                                      <?php echo form_error('distributorEmail'); ?>
                                        </div>
                                    <?php endif; ?>  
                                    <?php if ($controller_config['disable_distributor_phone'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="distributorPhone">Phone</label>
                                            <textarea class="form-control"
                                                      id="distributorPhone" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?>
                                                      placeholder="Phone"
                                                      name="distributorPhone"><?= set_value('distributorPhone', empty($distributor->phone) ? '' : $distributor->phone) ?></textarea>
                                                      <?php echo form_error('distributorPhone'); ?>
                                        </div>
                                    <?php endif; ?>  
                                    <?php if ($controller_config['disable_distributor_fax'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="distributorFax">Fax</label>
                                            <textarea class="form-control"
                                                      id="distributorFax" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?>
                                                      placeholder="Fax"
                                                      name="distributorFax"><?= set_value('distributorFax', empty($distributor->fax) ? '' : $distributor->fax) ?></textarea>
                                                      <?php echo form_error('distributorFax'); ?>
                                        </div>
                                    <?php endif; ?>  
                                    <?php if ($controller_config['disable_distributor_city'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="distributorFax">City</label>
                                            <input type="text"
                                                   class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                   id="distributorCity" placeholder="City" name="distributorCity"
                                                   value="<?= set_value('distributorCity', empty($distributor->city) ? '' : $distributor->city) ?>">
                                                   <?php echo form_error('distributorCity'); ?>
                                        </div>
                                    <?php endif; ?>  
                                    <?php if ($controller_config['disable_distributor_state'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="distributorFax">State</label>
                                            <input type="text"
                                                   class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                   id="distributorState" placeholder="State" name="distributorState"
                                                   value="<?= set_value('distributorState', empty($distributor->state) ? '' : $distributor->state) ?>">
                                                   <?php echo form_error('distributorState'); ?>
                                        </div>
                                    <?php endif; ?>  
                                    <?php if ($controller_config['disable_distributor_country'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="distributorCountry">Country</label>
                                            <select class="custom-select" id="distributorCountry" name="distributorCountry">
                                                <option value="">Select</option>
                                                <?php
                                                if ($countries):
                                                    foreach ($countries as $country):
                                                        ?>
                                                        <option value="<?= $country->id ?>" <?= $country->id == set_value('distributorCountry', empty($distributor->country) ? '' : $distributor->country) ? 'selected' : '' ?>><?= $country->name ?></option>
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </select>											
                                            <?php echo form_error('distributorCountry'); ?>
                                        </div>
                                    <?php endif; ?>  
                                    <?php if ($controller_config['disable_distributor_website'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="distributorWebsite">Website</label>
                                            <textarea class="form-control"
                                                      id="distributorWebsite" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?>
                                                      placeholder="Map"
                                                      name="distributorWebsite"><?= set_value('distributorWebsite', empty($distributor->website) ? '' : $distributor->website) ?></textarea>
                                                      <?php echo form_error('distributorWebsite'); ?>
                                        </div>
                                    <?php endif; ?>  
                                    <?php if ($controller_config['disable_distributor_map'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="distributorFax">Map</label>
                                            <textarea class="form-control"
                                                      id="distributorMap" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?>
                                                      placeholder="Map"
                                                      name="distributorMap"><?= set_value('distributorMap', empty($distributor->map) ? '' : $distributor->map) ?></textarea>
                                                      <?php echo form_error('distributorMap'); ?>
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