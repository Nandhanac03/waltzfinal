<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">What We Do</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/career/all') ?>">What We Do</a></li>
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
                        <form role="form" method="post" action="<?= site_url('panel/career/add') ?>"
                              enctype="multipart/form-data" id="careerForm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="careerTitle">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="careerTitle" placeholder="Title"
                                               name="careerTitle" value="<?= set_value('careerTitle') ?>">
                                               <?php echo form_error('careerTitle'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_career_short_desc'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="careerShortDesc">Short Description</label>
                                            <textarea class="form-control ckeditor" id="careerShortDesc"
                                                      placeholder="Short Description"
                                                      name="careerShortDesc"><?= set_value('careerShortDesc') ?></textarea>
                                                      <?php echo form_error('careerShortDesc'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group col-sm-12">
                                        <label for="careerDescription">Description</label>
                                        <textarea class="form-control ckeditor" id="careerDescription"
                                                  placeholder="Description"
                                                  name="careerDescription"><?= set_value('careerDescription') ?></textarea>
                                                  <?php echo form_error('careerDescription'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_career_description_img'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="careerDescImg">Description Image <a href="javascript:void(0)"
                                                                                            class="text-info"
                                                                                            data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i
                                                        class="fa fa-info-circle"></i></a></label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="careerDescImg"
                                                       id="careerDescImg" accept=".png,.jpg,.jpeg">
                                                <label for="careerDescImg" class="tower-file-button"> <span
                                                        class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>		
                                            <div id="careerBannerImgError"
                                                 class="error-text"><?= $careerDescImgError ?></div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-sm-12 mt-4">
                                        <button type="submit" class="btn btn-success float-right">Save</button>
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