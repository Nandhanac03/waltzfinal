<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Other Distributor</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/other_distributor/all') ?>">Brand</a></li>
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
                        <form role="form" method="post" action="<?= site_url('panel/other_distributor/add') ?>"
                              enctype="multipart/form-data" id="otherDistributorForm">
                            <div class="card-body">
                                <div class="row">
                                    <?php if ($controller_config['disable_other_distributor_category'] !== TRUE): ?>
                                    <div class="form-group">
                                         <label for="otherDistributorCategory">Category <span class="text-danger">*</span></label>
                                         <select class="custom-select" id="otherDistributorCategory" name="otherDistributorCategory">
                                            <option value="">Select</option>
                                            <?php
                                            if ($distributor_categories):
                                                foreach ($distributor_categories as $distributor_category_key=>$distributor_category):
                                                    ?>
                                                    <option value="<?= $distributor_category_key?>" <?= $distributor_category_key == set_value('otherDistributorCategory') ? 'selected' : '' ?>><?= $distributor_category ?></option>
                                                    <?php
                                                endforeach;
                                            endif;
                                            ?>
                                        </select>
                                        <?php echo form_error('otherDistributorCategory'); ?>
                                    </div>
                                    <?php endif; ?>
                                    <div class="form-group col-sm-12">
                                        <label for="otherDistributorTitle">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="otherDistributorTitle" placeholder="Title"
                                               name="otherDistributorTitle" value="<?= set_value('otherDistributorTitle') ?>">
                                               <?php echo form_error('otherDistributorTitle'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_other_distributor_description'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="otherDistributorDescription">Description</label>
                                            <textarea class="form-control ckeditor" id="otherDistributorDescription"
                                                      placeholder="Description"
                                                      name="otherDistributorDescription"><?= set_value('otherDistributorDescription') ?></textarea>
                                                      <?php echo form_error('otherDistributorDescription'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_other_distributor_img'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="otherDistributorImg">Distributor Image <a href="javascript:void(0)" class="text-info"
                                                                                 data-toggle="tooltip" data-placement="top"
                                                                                 title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i
                                                        class="fa fa-info-circle"></i></a></label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="otherDistributorImg" id="otherDistributorImg"
                                                       accept=".png,.jpg,.jpeg">
                                                <label for="otherDistributorImg" class="tower-file-button"> <span
                                                        class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <div id="otherDistributorImgError" class="error-text"><?= $otherDistributorImgError ?></div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_other_distributor_link'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="otherDistributorLink">Link </label>
                                            <input type="text" class="form-control" id="otherDistributorLink" placeholder="Link"
                                                   name="otherDistributorLink" value="<?= set_value('otherDistributorLink') ?>">
                                                   <?php echo form_error('otherDistributorLink'); ?>
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