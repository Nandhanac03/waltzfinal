<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Company</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/company/all') ?>">Company</a></li>
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
                        <form role="form" method="post" action="<?= site_url('panel/company/add') ?>"
                              enctype="multipart/form-data" id="companyForm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="companyName">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="companyName" placeholder="Name"
                                               name="companyName" value="<?= set_value('companyName') ?>">
                                               <?php echo form_error('companyName'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_company_description'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="companyDescription">Description</label>
                                            <textarea class="form-control ckeditor" id="companyDescription"
                                                      placeholder="Description"
                                                      name="companyDescription"><?= set_value('companyDescription') ?></textarea>
                                                      <?php echo form_error('companyDescription'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_company_img'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="companyImg">Company Image <a href="javascript:void(0)" class="text-info"
                                                                                     data-toggle="tooltip" data-placement="top"
                                                                                     title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i
                                                        class="fa fa-info-circle"></i></a></label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="companyImg" id="companyImg"
                                                       accept=".png,.jpg,.jpeg">
                                                <label for="companyImg" class="tower-file-button"> <span
                                                        class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <div id="companyImgError" class="error-text"><?= $companyImgError ?></div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_company_link'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="companyLink">Link </label>
                                            <input type="text" class="form-control" id="companyLink" placeholder="Link"
                                                   name="companyLink" value="<?= set_value('companyLink') ?>">
                                                   <?php echo form_error('companyLink'); ?>
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