<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Status</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/status/all') ?>">Status</a></li>
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
                        <form role="form" method="post" action="<?= site_url('panel/status/add') ?>" id="statusForm" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="statusTitle">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="statusTitle" placeholder="Title" name="statusTitle" value="<?= set_value('statusTitle') ?>" onchange="generate_slug_title(this, 'statusSlugTitle')">
                                        <?php echo form_error('statusTitle'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_status_slug_title'] != TRUE) : ?>
                                        <div class="form-group col-sm-12" style="display: none;">
                                            <label for="statusSlugTitle">Slug Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="statusSlugTitle" placeholder="Slug Title" name="statusSlugTitle" value="<?= set_value('statusSlugTitle') ?>">
                                            <?php echo form_error('statusSlugTitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_status_counter'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="statusCounter">Count</label>
                                            <input type="text" class="form-control" id="statusCouter" placeholder="Count" name="statusCounter" value="<?= set_value('statusCounter') ?>">
                                            <?php echo form_error('statusCounter'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($controller_config['disable_bio_description_img'] != TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="bioDescImg">Description Image <a href="javascript:void(0)"
                                                    class="text-info"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i
                                                        class="fa fa-info-circle"></i></a></label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="bioDescImg"
                                                    id="bioDescImg" accept=".png,.jpg,.jpeg">
                                                <label for="bioDescImg" class="tower-file-button"> <span
                                                        class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <div id="bioDescImgError" class="error-text"><?= $bioDescImgError ?></div>
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