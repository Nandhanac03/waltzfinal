<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">FAQ</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/faq/all') ?>">FAQ</a></li>
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
                        <form role="form" method="post" action="<?= site_url('panel/faq/edit/').$faq->id ?>" enctype="multipart/form-data" id="jobsForm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="title">Question <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="<?= set_value('title', empty($faq->title) ? '' : $faq->title) ?>" onchange="generate_slug_title(this, 'slugTitle')">
                                        <?php echo form_error('title'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_slug_title'] != TRUE) : ?>
                                        <div class="form-group col-sm-12" style="display: none;">
                                            <label for="slugTitle">Slug Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="slugTitle" placeholder="Slug Title" name="slugTitle" value="<?= set_value('slugTitle', empty($faq->title_slug) ? '' : $faq->title_slug) ?>">
                                            <?php echo form_error('slugTitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_short_description'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="shortDesc">Answer</label>
                                            <textarea class="form-control ckeditor" id="shortDesc" placeholder="Short Description" name="shortDesc"><?= set_value('shortDesc', empty($faq->short_desc) ? '' : $faq->short_desc) ?></textarea>
                                            <?php echo form_error('shortDesc'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_faq_status'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12 col-md-4">
                                            <label for="faqStatus">Status<span class="text-danger">*</span></label>
                                            <select class="custom-select" id="faqStatus" name="faqStatus">
                                                <option value="">Select</option>
                                                <option value='1' <?= $faq->active == 1 ? 'selected' : '' ?>>
                                                    Active
                                                </option>
                                                <option value='0' <?= $faq->active != 1 ? 'selected' : '' ?>>
                                                    Inactive
                                                </option>
                                            </select>
                                            <?php echo form_error('faqStatus'); ?>
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