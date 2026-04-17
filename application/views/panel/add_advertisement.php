<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Advertisement</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/advertisement/all') ?>">Advertisement</a>
                        </li>
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
                        <form role="form" method="post" action="<?= site_url('panel/advertisement/add') ?>"
                              enctype="multipart/form-data" id="advertisementForm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="advertisementTitle">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="advertisementTitle"
                                               placeholder="Title" name="advertisementTitle"
                                               value="<?= set_value('advertisementTitle') ?>">
                                               <?php echo form_error('advertisementTitle'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_advertisement_description'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="advertisementDescription">Description</label>
                                            <textarea class="form-control ckeditor" id="advertisementDescription"
                                                      placeholder="Description"
                                                      name="advertisementDescription"><?= set_value('advertisementDescription') ?></textarea>
                                                      <?php echo form_error('advertisementDescription'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_advertisement_link'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="advertisementLink">Link </label>
                                            <input type="text" class="form-control" id="advertisementLink"
                                                   placeholder="Title" name="advertisementLink"
                                                   value="<?= set_value('advertisementLink') ?>">
                                                   <?php echo form_error('advertisementLink'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_advertisement_button_name'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="advertisementButtonName">Button </label>
                                            <input type="text" class="form-control" id="advertisementButtonName"
                                                   placeholder="Title" name="advertisementButtonName"
                                                   value="<?= set_value('advertisementButtonName') ?>">
                                                   <?php echo form_error('advertisementButtonName'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_advertisement_img'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="advertisementImg">Advertisement Image <a href="javascript:void(0)"
                                                                                                 class="text-info"
                                                                                                 data-toggle="tooltip"
                                                                                                 data-placement="top"
                                                                                                 title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i
                                                        class="fa fa-info-circle"></i></a></label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="advertisementImg"
                                                       id="advertisementImg" accept=".png,.jpg,.jpeg">
                                                <label for="advertisementImg" class="tower-file-button"> <span
                                                        class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <div id="advertisementBannerImgError"
                                                 class="error-text"><?= $advertisementImgError ?></div>
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