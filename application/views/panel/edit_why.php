<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Why Work with Us</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/why/all') ?>">Why Work with Us</a></li>
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
                        <form role="form" method="post" action="<?= site_url('panel/why/edit/').$why->id ?>" enctype="multipart/form-data" id="jobsForm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="title">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="<?= set_value('title', empty($why->title) ? '' : $why->title) ?>" onchange="generate_slug_title(this, 'slugTitle')">
                                        <?php echo form_error('title'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_slug_title'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="slugTitle">Slug Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="slugTitle" placeholder="Slug Title" name="slugTitle" value="<?= set_value('slugTitle', empty($why->title_slug) ? '' : $why->title_slug) ?>">
                                            <?php echo form_error('slugTitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_short_description'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="shortDesc">Short Description</label>
                                            <input type="text" class="form-control" id="shortDesc" placeholder="Short Description" name="shortDesc" value="<?= set_value('shortDesc', empty($why->short_desc) ? '' : $why->short_desc) ?>">
                                            <!-- <textarea class="form-control ckeditor" id="shortDesc" placeholder="Short Description" name="shortDesc"><?= set_value('shortDesc', empty($why->short_desc) ? '' : $why->short_desc) ?></textarea> -->
                                            <?php echo form_error('shortDesc'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_why_status'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12 col-md-4">
                                            <label for="whyStatus">Status<span class="text-danger">*</span></label>
                                            <select class="custom-select" id="whyStatus" name="whyStatus">
                                                <option value="">Select</option>
                                                <option value='1' <?= $why->active == 1 ? 'selected' : '' ?>>
                                                    Active
                                                </option>
                                                <option value='0' <?= $why->active != 1 ? 'selected' : '' ?>>
                                                    Inactive
                                                </option>
                                            </select>
                                            <?php echo form_error('whyStatus'); ?>
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