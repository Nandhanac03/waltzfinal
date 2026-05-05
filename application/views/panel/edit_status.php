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
                        <form role="form" method="post" action="<?= site_url('panel/status/edit/').$status->id ?>" id="statusForm" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="statusTitle">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="statusTitle" placeholder="Title" name="statusTitle" value="<?= set_value('statusTitle', empty($status->title) ? '' : $status->title) ?>" onchange="generate_slug_title(this, 'statusSlugTitle')">
                                        <?php echo form_error('statusTitle'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_status_slug_title'] != TRUE) : ?>
                                        <div class="form-group col-sm-12" style="display: none;">
                                            <label for="statusSlugTitle">Slug Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="statusSlugTitle" placeholder="Slug Title" name="statusSlugTitle" value="<?= set_value('statusSlugTitle', empty($status->slug_title) ? '' : $status->slug_title) ?>">
                                            <?php echo form_error('statusSlugTitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_status_counter'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="statusCounter">Count</label>
                                            <input type="text" class="form-control" id="statusCouter" placeholder="Count" name="statusCounter" value="<?= set_value('statusCouter', empty($status->count) ? '' : $status->count) ?>">
                                            <?php echo form_error('statusCounter'); ?>
                                        </div>
                                    <?php endif; ?>






                             <!-- IMAGE UPLOAD --> <div class="form-group col-sm-12"> <label>Upload Image</label> <input type="file" name="statusCoverImg" class="form-control" accept=".jpg,.jpeg,.png"> <!-- ERROR --> <?php if (!empty($bioDescImgError)) : ?> <small class="text-danger"><?= $bioDescImgError ?></small> <?php endif; ?> </div> <!-- CURRENT IMAGE PREVIEW --> <?php if (!empty($status->image)) : ?> <div class="col-sm-12 mt-3"> <label>Current Image</label><br> <img src="<?= base_url('assets/uploads/status/'.$status->image) ?>" style="max-width:200px; border:1px solid #ddd; padding:5px;"> </div> <?php endif; ?>






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