<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Gallery</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/album/all') ?>">Gallery</a></li>
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
                        <form role="form" method="post" action="<?= site_url('panel/album/edit/' . $album->id) ?>" enctype="multipart/form-data" id="articleForm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="albumTitle">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="albumTitle" placeholder="Title" name="albumTitle" value="<?= set_value('albumTitle', $album->title) ?>">
                                        <?php echo form_error('albumTitle'); ?>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="albumFile">Upload Images <a href="javascript:void(0)" class="text-info" data-toggle="tooltip" data-placement="top" title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i class="fa fa-info-circle"></i></a></label>
                                        <div class="tower-file">
                                            <input type="file" multiple class="custom_fileInput" name="albumFile[]" id="albumFile" accept=".png,.jpg,.jpeg">
                                            <label for="albumFile" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse </label>
                                            <button type="button" class="tower-file-clear tower-file-button">
                                                Clear
                                            </button>
                                        </div>
                                        <div id="albumImgError" class="error-text"><?= $albumImgError ?></div>
                                        <?php
                                        if ($album->id == 2) {
                                            $maxSize = '<i>* Recommended image dimension 270 x 126px. Supports jpg, jpeg and png.*</i>';
                                            $minSize = '';
                                        } elseif ($album->id == 3) {
                                            $maxSize = '<i>* Recommended image dimension 1200 x 326px. Supports jpg, jpeg and png.*</i>';
                                            $minSize = '';
                                        } elseif ($album->id == 4) {
                                            $maxSize = '<i>* Recommended image dimension 300 x 300px. Supports jpg, jpeg and png.*</i>';
                                            $minSize = '';
                                        }elseif ($album->id == 1) {
                                            $maxSize = '<i>* Recommended image dimension 1200 x 326px. Supports jpg, jpeg and png.*</i>';
                                            $minSize = '';
                                        }elseif ($album->id == 5) {
                                            $maxSize = '<i>* Recommended image dimension 1200 x 326px. Supports jpg, jpeg and png.*</i>';
                                            $minSize = '';
                                        } else {
                                            $maxSize = '';
                                            $minSize = '';
                                        }
                                        ?>
                                        <div class="row">
                                            <?= '<p class="text-danger fw-bolder">' . $maxSize . '</p>' ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12" id="albumImagesGridView">
                                            <?php if ($album_files) : foreach ($album_files as $album_file) : ?>
                                                    <div class="file-img-container" style="<?php if ($album->id == 3 || $album->id == 2) {
                                                                                                echo 'max-width: 400px;';
                                                                                            } ?>">
                                                        <div class="file-img-container-option">
                                                            <?php if ($controller_config['disable_album_file_delete'] != TRUE) : ?>
                                                                <a href="javascript:void(0)" class="file_edit_btn trigger_alert_modal" data-title="Confirm" data-desc="Are you sure want to delete this?" data-redirect="<?= base_url('panel/album/delete_file/' . $album->id . '/' . $album_file->id) ?>"><i class="fas fa-trash text-dark"></i> </a>
                                                            <?php endif; ?>
                                                            <?php if ($controller_config['disable_album_file_edit'] != TRUE) : ?>
                                                                <a href="<?= base_url('panel/album/edit_file/' . $album->id . '/' . $album_file->id) ?>" class="file_edit_btn text-dark" title="Edit"><i class="fas fa-edit"></i> </a>
                                                            <?php endif; ?>
                                                        </div>
                                                        <img src="<?= base_url('assets/uploads/album/thumb_' . $album_file->file) ?>" class="img-fluid" style="width: 100%;" />
                                                    </div>
                                            <?php
                                                endforeach;
                                            endif;
                                            ?>
                                        </div>
                                    </div>
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