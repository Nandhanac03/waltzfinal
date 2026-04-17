<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Privacy Policy</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/faq/all') ?>">Privacy Policy</a></li>
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
                        <form role="form" method="post" action="<?= site_url('panel/policy/add') ?>" enctype="multipart/form-data" id="jobsForm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="title">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="<?= set_value('title') ?>" onchange="generate_slug_title(this, 'slugTitle')">
                                        <?php echo form_error('title'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_slug_title'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="slugTitle">Slug Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="slugTitle" placeholder="Slug Title" name="slugTitle" value="<?= set_value('slugTitle') ?>">
                                            <?php echo form_error('slugTitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_short_description'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="shortDesc">Short Description</label>
                                            <textarea class="form-control ckeditor" id="shortDesc" placeholder="Short Description" name="shortDesc"><?= set_value('shortDesc') ?></textarea>
                                            <?php echo form_error('shortDesc'); ?>
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