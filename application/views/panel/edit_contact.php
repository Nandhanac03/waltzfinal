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
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/page') ?>">Contacts</a></li>
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
                        <form role="form" method="post" action="<?= site_url('panel/contact/edit/' . $id . '/' . $lang) ?>" enctype="multipart/form-data" id="contactForm">
                            <div class="card-body">
                                <?php if ($languages && count($languages) > 1 && $controller_config['disable_contact_languages'] != TRUE) : ?>
                                    <ul class="nav nav-tabs mb-4" id="news-content-below-tab" role="tablist">
                                        <?php
                                        $i = 1;
                                        foreach ($languages as $language) :
                                        ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?= in_array($language->id, $contact_languages) && $language->id != $lang ? ' bg-navy' : '' ?><?= $language->id == $lang ? ' active bg-success' : '' ?>" href="<?= base_url('panel/contact/edit/' . $id . '/' . $language->id) ?>" role="tab" aria-selected="true"><?= $language->name ?></a>
                                            </li>
                                        <?php
                                        endforeach;
                                        ?>
                                    </ul>
                                <?php endif; ?>
                                <div class="row">
                                    <?php if ($controller_config['disable_contact_name'] != true) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="contactTitle">Name</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="contactName" placeholder="Name" name="contactName" value="<?= set_value('contactName', empty($contact->full_name) ? '' : $contact->full_name) ?>">
                                            <?php echo form_error('contactName'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_contact_address'] != true) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="contactAddress">Address</label>
                                            <textarea class="ckeditor form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="contactAddress" placeholder="Address" name="contactAddress"><?= set_value('contactAddress', empty($contact->address) ? '' : $contact->address) ?></textarea>
                                            <?php echo form_error('contactAddress'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_contact_email'] != true) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="contactEmail">Email</label>
                                            <textarea class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="contactEmail" placeholder="Email" name="contactEmail"><?= set_value('contactEmail', empty($contact->email) ? '' : $contact->email) ?></textarea>
                                            <?php echo form_error('contactEmail'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_contact_phone'] != true) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="contactPhone">Phone</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="contactPhone" placeholder="" maxlength="30" name="contactPhone" value="<?= set_value('contactPhone', empty($contact->phone) ? '' : $contact->phone) ?>">
                                            <?php echo form_error('contactPhone'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_contact_fax'] != true) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="contactFax">Contact Number for Tele-communication </label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="contactFax" placeholder="" maxlength="30" name="contactFax"value="<?= set_value('contactFax', empty($contact->fax) ? '' : $contact->fax) ?>">
                                            <?php echo form_error('contactFax'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_contact_working_hours'] != true) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="contactWorkHour">Working Hours</label>
                                            <textarea class="ckeditor form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="contactWorkHour" placeholder="Working Hours" name="contactWorkHour"><?= set_value('contactWorkHour', empty($contact->work_hour) ? '' : $contact->work_hour) ?></textarea>
                                            <?php echo form_error('contactWorkHour'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_contact_map'] != true) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="contactMap">Map Link</label>
                                            <textarea class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="contactMap" placeholder="Map" name="contactMap"><?= set_value('contactMap', empty($contact->map) ? '' : $contact->map) ?></textarea>
                                            <?php echo form_error('contactMap'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_contact_iframe_code'] != true) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="location_iframe">Location IFRAME Code</label>
                                            <textarea class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="location_iframe" placeholder="Map" name="location_iframe"><?= set_value('location_iframe', empty($contact->location_iframe) ? '' : $contact->location_iframe) ?></textarea>
                                            <?php echo form_error('location_iframe'); ?>
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