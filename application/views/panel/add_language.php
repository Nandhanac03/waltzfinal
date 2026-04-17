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
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/language/all') ?>">Languages</a></li>
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
                        <form role="form" method="post" enctype="multipart/form-data"
                              action="<?= site_url('panel/language/add') ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="lname">Language <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="lname" placeholder="Name"
                                               name="lname" value="<?= set_value('lname') ?>">
                                               <?php echo form_error('lname'); ?>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="lcode">Code <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="lcode" placeholder="Code"
                                               name="lcode" value="<?= set_value('lcode') ?>">
                                               <?php echo form_error('lcode'); ?>
                                    </div>
                                    <div class="form-group  col-sm-12 clearfix">
                                        <label for="ldirection" class="mr-15">Direction</label>
                                        <select class="form-control select2" data-placeholder="Select a Direction"
                                                name="ldirection">
                                            <option value="1" <?php if (isset($_POST['ldirection']) == 1) echo 'selected'; ?>>
                                                LTR
                                            </option>
                                            <option value="2" <?php if (isset($_POST['ldirection']) == 2) echo 'selected'; ?>>
                                                RTL
                                            </option>
                                        </select>
                                        <?php echo form_error('ldirection'); ?>
                                    </div>								
                                    <div class="form-group col-sm-12 clearfix">
                                        <label for="ltype" class="mr-15">Lang For <span
                                                class="text-danger">*</span></label>
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" name="lang_for[]" value="S" id="checkboxPrimary1">
                                            <label for="checkboxPrimary1">Site </label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" name="lang_for[]" value="N" id="checkboxPrimary2">
                                            <label for="checkboxPrimary2">News </label>
                                        </div>
                                        <?php echo form_error('lang_for[]'); ?>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="lflag">Flag</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="lflag" name="lflag">
                                                <label class="custom-file-label" for="lflag">Choose flag</label>
                                            </div>
                                        </div>
                                        <span class="text-danger"><?php if ($image_error != '') echo $image_error; ?></span>
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