<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Partner</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/partner/all') ?>">Partner</a></li>
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
                        <form role="form" method="post" action="<?= site_url('panel/partner/add') ?>"
                              enctype="multipart/form-data" id="partnerForm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="partnerName">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="partnerName" placeholder="Name"
                                               name="partnerName" value="<?= set_value('partnerName') ?>">
                                               <?php echo form_error('partnerName'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_partner_description'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="partnerDescription">Description</label>
                                            <textarea class="form-control ckeditor" id="partnerDescription"
                                                      placeholder="Description"
                                                      name="partnerDescription"><?= set_value('partnerDescription') ?></textarea>
                                                      <?php echo form_error('partnerDescription'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_partner_img'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="partnerImg">Partner Image <a href="javascript:void(0)" class="text-info"
                                                                                     data-toggle="tooltip" data-placement="top"
                                                                                     title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i
                                                        class="fa fa-info-circle"></i></a></label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="partnerImg" id="partnerImg"
                                                       accept=".png,.jpg,.jpeg">
                                                <label for="partnerImg" class="tower-file-button"> <span
                                                        class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <div id="partnerImgError" class="error-text"><?= $partnerImgError ?></div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_partner_link'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="partnerLink">Link </label>
                                            <input type="text" class="form-control" id="partnerLink" placeholder="Link"
                                                   name="partnerLink" value="<?= set_value('partnerLink') ?>">
                                                   <?php echo form_error('partnerLink'); ?>
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