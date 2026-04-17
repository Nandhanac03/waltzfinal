<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Language</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/language/all') ?>">Language</a></li>
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
                        <form role="form" method="post" enctype="multipart/form-data"
                              action="<?= site_url('panel/language/edit/' . $language->id) ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="lname">Language <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="lname" placeholder="Name"
                                               name="lname" value="<?= set_value('lname', $language->name) ?>">
                                               <?php echo form_error('lname'); ?>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="uRegEmail">Code <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="lcode" placeholder="Code"
                                               name="lcode" value="<?= set_value('lcode', $language->code) ?>">
                                               <?php echo form_error('lcode'); ?>
                                    </div>
                                    <div class="form-group  col-sm-12 clearfix">
                                        <label for="ldirection" class="mr-15">Direction</label>
                                        <select class="form-control select2" data-placeholder="Select a Direction"
                                                name="ldirection">
                                            <option value="1" <?php if ($language->direction == 'ltr') echo 'selected'; ?>>
                                                LTR
                                            </option>
                                            <option value="2" <?php if ($language->direction == 'rtl') echo 'selected'; ?>>
                                                RTL
                                            </option>
                                        </select>
                                        <?php echo form_error('ldirection'); ?>
                                    </div>
                                    <div class="form-group col-sm-12 clearfix">
                                        <label for="ltype" class="mr-15">Lang For <span
                                                class="text-danger">*</span></label>
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" name="lang_for[]" value="S"
                                                   id="checkboxPrimary1" <?php if ($language->for_site == '1') echo 'checked' ?>>
                                            <label for="checkboxPrimary1">Site </label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" name="lang_for[]" value="N"
                                                   id="checkboxPrimary2" <?php if ($language->for_news == '1') echo 'checked' ?>>
                                            <label for="checkboxPrimary2">News </label>
                                        </div>
                                        <?php echo form_error('lang_for[]'); ?>
                                    </div>															
                                    <div class="form-group col-sm-12">
                                        <label for="lflag">Flag</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom_filestyle" id="lflag" name="lflag">
                                                <label class="custom-file-label" for="lflag">Choose flag</label>
                                            </div>
                                        </div>
                                        <?php if (file_exists(FCPATH . 'assets/uploads/flag/' . $language->flag) && $language->flag != ''): ?>
                                            <img src="<?= base_url('assets/uploads/flag/' . $language->flag) ?>"
                                                 class="img-fluid mt-2">
                                             <?php endif; ?>
                                        <span class="text-danger"><?php if ($image_error != '') echo $image_error; ?></span>
                                    </div>
                                    <div class="form-group  col-sm-12">
                                        <label for="lstatus">Status <span class="text-danger">*</span></label>
                                        <div class="select2-primary">
                                            <select class="form-control select2bs4 select2-primary" name="lstatus"
                                                    id="lstatus" data-dropdown-css-class="select2-primary"
                                                    style="width: 100%;">
                                                <option value="A" <?= $language->status == 1 ? 'selected' : '' ?>>Active
                                                </option>
                                                <option value="D" <?= $language->status != 1 ? 'selected' : '' ?>>Inactive
                                                </option>
                                            </select>
                                        </div>
                                        <?php echo form_error('lstatus'); ?>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div><!-- /.content-wrapper -->