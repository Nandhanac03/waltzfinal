<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">File</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/album/edit/' . $album->id) ?>">Album</a>
                        </li>
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
                        <form role="form" method="post"
                              action="<?= site_url('panel/album/edit_file/' . $album->id . '/' . $album_parent_file->id . '/' . $current_language->id) ?>"
                              enctype="multipart/form-data" id="fileForm">
                            <div class="card-body">						
                                <?php if ($languages && count($languages) > 1 && $controller_config['disable_album_file_languages'] !== TRUE): ?>
                                    <ul class="nav nav-tabs mb-4" id="news-content-below-tab" role="tablist">
                                        <?php
                                        $i = 1;
                                        foreach ($languages as $language):
                                            ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?= in_array($language->id, $file_desc_languages) && $language->id != $current_language->id ? ' bg-navy' : '' ?><?= $language->id == $current_language->id ? ' active bg-success' : '' ?>"
                                                   href="<?= base_url('panel/album/edit_file/' . $album->id . '/' . $album_parent_file->id . '/' . $language->id) ?>"
                                                   role="tab" aria-selected="true"><?= $language->name ?></a>
                                            </li>
                                            <?php
                                        endforeach;
                                        ?>
                                    </ul>
                                <?php endif; ?>



                                <?php 
$isHomeBanner = ($album->id == 1); 
?>

<?php 
$isProductBanner = ($album->id == 4); 
?>

                                <div class="row">
                                <?php if ($isHomeBanner) { ?>
                                    <div class="form-group col-sm-12">
                                        <label for="fileTitle">Title <span class="text-danger">*</span></label>
                                        <input type="text"
                                               class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                               id="fileTitle" placeholder="Title" name="fileTitle"
                                               value="<?= set_value('fileTitle', empty($album_file_desc->title) ? '' : $album_file_desc->title) ?>">
                                               <?php echo form_error('fileTitle'); ?>
                                    </div>
                                    <?php } ?>
                                   <?php if ($isProductBanner) { ?>
                                    <?php if ($controller_config['disable_album_file_subtitle'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="fileSubtitle">Subtitle</label>
                                            <input type="text"
                                                   class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                   id="fileSubtitle" placeholder="Subtitle" name="fileSubtitle"
                                                   value="<?= set_value('fileSubtitle', empty($album_file_desc->subtitle) ? '' : $album_file_desc->subtitle) ?>">
                                                   <?php echo form_error('fileSubtitle'); ?>
                                        </div>
                                    <?php endif; ?>
                             <?php } ?>
                             <?php if ($isHomeBanner) { ?>
                                    <?php if ($controller_config['disable_album_file_short_desc'] == TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="fileShortDesc">Short Description</label>
                                            <textarea class="form-control ckeditor"
                                                      id="fileShortDesc" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?>
                                                      placeholder="Short Description"
                                                      name="fileShortDesc"><?= set_value('fileShortDesc', empty($album_file_desc->short_desc) ? '' : $album_file_desc->short_desc) ?></textarea>
                                                      <?php echo form_error('fileShortDesc'); ?>
                                        </div>
                                    <?php endif; ?>
                                 
                                    <?php if ($controller_config['disable_album_file_desc'] !== TRUE): ?>
                                    <div class="form-group col-sm-12">
                                        <label for="fileDescription">Description</label>
                                        <!-- ckeditor -->
                                        <textarea class="form-control"
                                                  id="fileDescription" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?>
                                                  placeholder="Description"
                                                  name="fileDescription"><?= set_value('fileDescription', empty($album_file_desc->description) ? '' : $album_file_desc->description) ?></textarea>
                                                  <?php echo form_error('fileDescription'); ?>
                                    </div>
                                    <?php endif; ?>
                                   
                                    <?php if ($controller_config['disable_album_file_link'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="fileLink">Link</label>
                                            <input type="text"
                                                   class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                   id="fileLink" placeholder="Link" name="fileLink"
                                                   value="<?= set_value('fileLink', empty($album_file_desc->link) ? '' : $album_file_desc->link) ?>">
                                                   <?php echo form_error('fileLink'); ?>
                                        </div>
                                    <?php endif; ?>
                                   
                                    <?php if ($controller_config['disable_album_file_button_name'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="fileButtonName">Button Name</label>
                                            <input type="text"
                                                   class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                   id="fileButtonName" placeholder="Button Name" name="fileButtonName"
                                                   value="<?= set_value('fileButtonName', empty($album_file_desc->button_name) ? '' : $album_file_desc->button_name) ?>">
                                                   <?php echo form_error('fileButtonName'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php } ?>
                                    <?php if ($album->id == 2) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="fileOrder">Order</label>
                                            <select class="form-control" id="fileOrder" name="fileOrder">
                                                <?php for ($i = 1; $i <= $total_files; $i++) : ?>
                                                    <option value="<?= $i ?>" <?= (isset($album_file->order) && $album_file->order == $i) ? 'selected' : '' ?>><?= $i ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_album_file_browse'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="fileDescImg">Upload Image <a href="javascript:void(0)"
                                                                                     class="text-info" data-toggle="tooltip"
                                                                                     data-placement="top"
                                                                                     title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i
                                                        class="fa fa-info-circle"></i></a></label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="fileAlbum"
                                                       id="fileAlbum" accept=".png,.jpg,.jpeg">
                                                <label for="fileAlbum" class="tower-file-button"> <span
                                                        class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <div id="fileAlbumError" class="error-text"><?= $fileAlbumError ?></div>
                                        </div>							
                                        <?php if (!empty($album_file->file)): ?>
                                            <div class="col-sm-12">
                                                <div class="file-img-container">
                                                    <img src="<?= base_url('assets/uploads/album/thumb_' . $album_file->file) ?>"
                                                         class="img-fluid"/>
                                                </div>
                                            </div>
                                        <?php endif; ?>
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