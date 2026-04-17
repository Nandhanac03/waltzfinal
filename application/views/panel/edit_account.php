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
                <div class="col-md-6 offset-md-3 col-sm-12">
                    <?= $alert ?>
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Edit</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="<?= site_url('panel/user/edit_account/' . $user->id) ?>">
                            <div class="card-body">
                                <?php if ($controller_config['disable_first_name'] != TRUE): ?>
                                    <div class="form-group">
                                        <label for="regFirstName">First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="regFirstName" placeholder="First name"
                                               name="regFirstName" value="<?= set_value('regFirstName', empty($profile->first_name)?'':$profile->first_name) ?>">
                                               <?php echo form_error('regFirstName'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_last_name'] != TRUE): ?>
                                    <div class="form-group">
                                        <label for="regLastName">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="regLastName" placeholder="Last name"
                                               name="regLastName" value="<?= set_value('regLastName',  empty($profile->last_name)?'':$profile->last_name) ?>">
                                               <?php echo form_error('regLastName'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_company'] != TRUE): ?>
                                    <div class="form-group">
                                        <label for="regEmail">Company </label>
                                        <input type="text" class="form-control" id="regCompany" placeholder="Company"
                                               name="regCompany" value="<?= set_value('regCompany',  empty($profile->company)?'':$profile->company) ?>">
                                               <?php echo form_error('regCompany'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_address'] != TRUE): ?>
                                    <div class="form-group">
                                        <label for="regAddress">Address </label>
                                        <textarea class="form-control" id="regAddress" placeholder="Address"
                                                  name="regAddress"><?= set_value('regAddress',  empty($profile->address)?'':$profile->address) ?></textarea>
                                                  <?php echo form_error('regAddress'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_city'] != TRUE): ?>
                                    <div class="form-group">
                                        <label for="regCity">City</label>
                                        <input type="text" class="form-control" id="regCity" placeholder="City"
                                               name="regCity" value="<?= set_value('regCity',  empty($profile->city)?'':$profile->city) ?>">
                                               <?php echo form_error('regCity'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_district'] != TRUE): ?>
                                    <div class="form-group">
                                        <label for="regState">State </label>
                                        <input type="text" class="form-control" id="regState" placeholder="State"
                                               name="regState" value="<?= set_value('regState',  empty($profile->state)?'':$profile->state) ?>">
                                               <?php echo form_error('regState'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_state'] != TRUE): ?>
                                    <div class="form-group">
                                        <label for="regCountry">Country </label>
                                        <select name="regCountry" class="select2 form-control" id="regCountry">
                                            <option value="">Select</option>
                                            <?php if ($countries): ?>
                                                <?php foreach ($countries as $country): ?>
                                                    <option value="<?= $country->id ?>"
                                                            <?= set_value('country', !empty($profile->country)?$profile->country:'') == $country->id ? 'selected' : '' ?>><?= $country->name ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php echo form_error('regCountry'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_country'] != TRUE): ?>
                                    <div class="form-group">
                                        <label for="regPostalCode">Zip/Postal Code <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="regPostalCode" placeholder="Zip/Postal Code"
                                               name="regPostalCode" value="<?= set_value('regPostalCode',  empty($profile->po_box)?'':$profile->po_box) ?>">
                                               <?php echo form_error('regPostalCode'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_postal_code'] != TRUE): ?>
                                    <div class="form-group">
                                        <label for="regPhone">Phone </label>
                                        <input type="text" class="form-control" id="regPhone" placeholder="Phone"
                                               name="regPhone" value="<?= set_value('regPhone',  empty($profile->phone)?'':$profile->phone) ?>">
                                               <?php echo form_error('regPhone'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_phone'] != TRUE): ?>
                                    <div class="form-group">
                                        <label for="regFax">Fax </label>
                                        <input type="text" class="form-control" id="regFax" placeholder="Fax"
                                               name="regFax" value="<?= set_value('regFax',  empty($profile->fax)?'':$profile->fax) ?>">
                                               <?php echo form_error('regFax'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_fax'] != TRUE): ?>
                                    <div class="form-group">
                                        <label for="regEmail">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="regEmail" placeholder="Email"
                                               name="regEmail" value="<?= set_value('regEmail',  empty($profile->email)?'':$profile->email) ?>">
                                               <?php echo form_error('regEmail'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_username'] != TRUE): ?>
                                    <div class="form-group">
                                        <label for="regUsername">Username <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="regUsername" placeholder="Username"
                                               name="regUsername" value="<?= set_value('regUsername', $user->username) ?>">
                                               <?php echo form_error('regUsername'); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="regEmail">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="regEmail" placeholder="Email"
                                           name="regEmail" value="<?= set_value('regEmail', $user->email) ?>">
                                           <?php echo form_error('regEmail'); ?>
                                </div>
                                <?php if ($controller_config['disable_group'] != TRUE): ?>
                                    <div class="form-group">
                                        <label for="regGroups">Group <span class="text-danger">*</span></label>
                                        <div class="select2-primary">
                                            <select class="form-control select2 select2-primary" name="regGroups[]"
                                                    id="regGroups" multiple="multiple" data-placeholder="Select a State"
                                                    data-dropdown-css-class="select2-primary" style="width: 100%;">
                                                        <?php
                                                        if ($groups) {
                                                            foreach ($groups as $group) {
                                                                $selected = '';
                                                                if (in_array($group['id'], $userGroups)) {
                                                                    $selected = 'selected';
                                                                }
                                                                echo '<option value="' . $group['id'] . '" ' . $selected . '>' . $group['name'] . $group_id . '</option>';
                                                            }
                                                        }
                                                        ?>
                                            </select>
                                        </div>
                                        <?php echo form_error('regGroups[]'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_status'] != TRUE): ?>
                                    <div class="form-group">
                                        <label for="regStatus">Status <span class="text-danger">*</span></label>
                                        <div class="select2-primary">
                                            <select class="form-control select2bs4 select2-primary" name="regStatus"
                                                    id="regStatus" data-dropdown-css-class="select2-primary"
                                                    style="width: 100%;">
                                                <option value="A" <?= $user->active == 1 ? 'selected' : '' ?>>Active</option>
                                                <option value="D" <?= $user->active != 1 ? 'selected' : '' ?>>Inactive</option>
                                            </select>
                                        </div>
                                        <?php echo form_error('regStatus'); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="alert alert-info alert-dismissible fade show mt-2 mb-2" role="alert">                                                                
                                    <strong>Info!</strong> Password validation only happens when fields is not empty. 
                                    Only fill when you want to change password otherwise its not required.
                                </div>
                                <div class="form-group">
                                    <label for="regPassword">Password</label>
                                    <input type="password" class="form-control" id="regPassword" name="regPassword"
                                           placeholder="Password">
                                           <?php echo form_error('regPassword'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="regConfirmPassword">Confirm Password</label>
                                    <input type="password" class="form-control" id="regConfirmPassword"
                                           name="regConfirmPassword" placeholder="Confirm Password">
                                           <?php echo form_error('regConfirmPassword'); ?>
                                </div>

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