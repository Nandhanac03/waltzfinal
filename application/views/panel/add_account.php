<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Account</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/user/accounts') ?>">Accounts</a></li>
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
                <div class="col-md-6 offset-md-3 col-sm-12">
                    <?= $alert ?>
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Add</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="<?= site_url('panel/user/add_account') ?>">
                            <div class="card-body">
                                <?php if ($controller_config['disable_first_name'] != TRUE): ?>
                                    <div class="form-group">
                                        <label for="regFirstName">First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="regFirstName" placeholder="First name"
                                               name="regFirstName" value="<?= set_value('regFirstName') ?>">
                                               <?php echo form_error('regFirstName'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_last_name'] != TRUE): ?>
                                    <div class="form-group">
                                        <label for="regLastName">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="regLastName" placeholder="Last name"
                                               name="regLastName" value="<?= set_value('regLastName') ?>">
                                               <?php echo form_error('regLastName'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_company'] != TRUE): ?>
                                    <div class="form-group">
                                        <label for="regEmail">Company </label>
                                        <input type="text" class="form-control" id="regCompany" placeholder="Company"
                                               name="regCompany" value="<?= set_value('regCompany') ?>">
                                               <?php echo form_error('regCompany'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_address'] != TRUE): ?>
                                    <div class="form-group">
                                        <label for="regAddress">Address </label>
                                        <textarea class="form-control" id="regAddress" placeholder="Address"
                                                  name="regAddress"><?= set_value('regAddress') ?></textarea>
                                                  <?php echo form_error('regAddress'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_city'] != TRUE): ?>
                                    <div class="form-group">
                                        <label for="regCity">City</label>
                                        <input type="text" class="form-control" id="regCity" placeholder="City"
                                               name="regCity" value="<?= set_value('regCity') ?>">
                                               <?php echo form_error('regCity'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_district'] != TRUE): ?>
                                    <div class="form-group">
                                        <label for="regDistrict">District</label>
                                        <input type="text" class="form-control" id="regDistrict" placeholder="District"
                                               name="regDistrict" value="<?= set_value('regDistrict') ?>">
                                               <?php echo form_error('regDistrict'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_state'] != TRUE): ?>
                                    <div class="form-group">
                                        <label for="regState">State </label>
                                        <input type="text" class="form-control" id="regState" placeholder="State"
                                               name="regState" value="<?= set_value('regState') ?>">
                                               <?php echo form_error('regState'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_country'] != TRUE): ?>
                                    <div class="form-group">
                                        <label for="regCountry">Country </label>
                                        <select name="regCountry" class="select2 form-control" id="regCountry">
                                            <option value="">Select</option>
                                            <?php if ($countries): ?>
                                                <?php foreach ($countries as $country): ?>
                                                    <option value="<?= $country->id ?>"
                                                            <?= set_value('regCountry') == $country->id ? 'selected' : '' ?>><?= $country->name ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php echo form_error('regCountry'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_postal_code'] != TRUE): ?>
                                    <div class="form-group">
                                        <label for="regPostalCode">Zip/Postal Code <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="regPostalCode" placeholder="Zip/Postal Code"
                                               name="regPostalCode" value="<?= set_value('regPostalCode') ?>">
                                               <?php echo form_error('regPostalCode'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_phone'] != TRUE): ?>
                                    <div class="form-group">
                                        <label for="regPhone">Phone </label>
                                        <input type="text" class="form-control" id="regPhone" placeholder="Phone"
                                               name="regPhone" value="<?= set_value('regPhone') ?>">
                                               <?php echo form_error('regPhone'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_fax'] != TRUE): ?>
                                    <div class="form-group">
                                        <label for="regFax">Fax </label>
                                        <input type="text" class="form-control" id="regFax" placeholder="Fax"
                                               name="regFax" value="<?= set_value('regFax') ?>">
                                               <?php echo form_error('regFax'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_username'] != TRUE): ?>
                                    <div class="form-group">
                                        <label for="regUsername">Username <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="regUsername" placeholder="Username"
                                               name="regUsername" value="<?= set_value('regUsername') ?>">
                                               <?php echo form_error('regUsername'); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="regEmail">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="regEmail" placeholder="Email"
                                           name="regEmail" value="<?= set_value('regEmail') ?>">
                                           <?php echo form_error('regEmail'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="regPassword">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="regPassword" name="regPassword"
                                           placeholder="Password">
                                           <?php echo form_error('regPassword'); ?>
                                </div>                                
                                <div class="form-group">
                                    <label for="regConfirmPassword">Confirm Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="regConfirmPassword"
                                           name="regConfirmPassword" placeholder="Confirm Password">
                                           <?php echo form_error('regConfirmPassword'); ?>
                                </div>
                                <?php if ($controller_config['disable_group'] != TRUE): ?>
                                    <div class="form-group">
                                        <label>Group <span class="text-danger">*</span></label>
                                        <div class="select2-primary">
                                            <select class="form-control select2 select2-primary" name="regGroups[]"
                                                    multiple="multiple" data-placeholder="Select a State"
                                                    data-dropdown-css-class="select2-primary" style="width: 100%;">
                                                        <?php
                                                        if ($groups) {
                                                            foreach ($groups as $group) {
                                                                echo '<option value="' . $group['id'] . '">' . $group['name'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                            </select>
                                        </div>
                                        <?php echo form_error('regGroups[]'); ?>
                                    </div>
                                <?php endif; ?>
                                <button type="submit" class="btn btn-primary mt-4">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div><!-- /.content-wrapper -->