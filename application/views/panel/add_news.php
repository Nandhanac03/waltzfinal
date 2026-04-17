<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">News</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/news/all') ?>">News</a></li>
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
                        <form role="form" method="post" action="<?= site_url('panel/news/add') ?>" enctype="multipart/form-data" id="newsForm">
                            <!-- hidden values -->
                            <!-- <input type="hidden" name="newsStatus" id="newsStatus"> -->
                            <div class="card-body">
                                <div class="row">
                                    <?php if ($controller_config['disable_news_type'] != TRUE) : ?>
                                        <div class="form-group col-sm-12 col-md-4">
                                            <label for="newsType">News Type <span class="text-danger">*</span></label>
                                            <select class="custom-select" id="newsType" name="newsType" onchange="newsTypeChanged(this)">
                                                <option value="">Select</option>
                                                <option value="N" <?= set_value('newsType') == 'N' ? 'selected' : '' ?>>Newsroom
                                                </option>
                                                <option value="M" <?= set_value('newsType') == 'M' ? 'selected' : '' ?>>
                                                    Multimedia Newsroom
                                                </option>
                                                <option value="PV" <?= set_value('newsType') == 'PV' ? 'selected' : '' ?>>Press
                                                    Video Newsroom
                                                </option>
                                            </select>
                                            <?php echo form_error('newsType'); ?>
                                        </div>
                                    <?php else : ?>
                                        <input type="hidden" name="newsType" id="newsType" value="1" onchange="newsTypeChanged(this)">
                                    <?php endif; ?>
                                    <div class="form-group col-sm-12">
                                        <label for="newsTitle">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="newsTitle" placeholder="Title" name="newsTitle" value="<?= set_value('newsTitle') ?>" onchange="generate_slug_title(this, 'newsSlugTitle')">
                                        <?php echo form_error('newsTitle'); ?>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="newsSlugTitle">Slug Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="newsSlugTitle" placeholder="Slug Title" name="newsSlugTitle" value="<?= set_value('newsSlugTitle') ?>">
                                        <?php echo form_error('newsSlugTitle'); ?>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="newsContent">Short Description</label>
                                        <textarea class="form-control ckeditor" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?> id="newsDescription" placeholder="Description" name="newsDescription"><?= set_value('newsDescription') ?></textarea>
                                        <?php echo form_error('newsDescription'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_news_subtitle'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="newsSubtitle">Hyperlink</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="newsSubtitle" placeholder="Redirection url" name="newsSubtitle" value="<?= set_value('newsSubtitle') ?>">
                                            <?php echo form_error('newsSubtitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_news_short_desc'] != TRUE) : ?>
                                        <div class="form-group col-sm-12" style="display: none;">
                                            <label for="newsShortDesc">Job Description Link</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="newsShortDesc" placeholder="Job Description Link" name="newsShortDesc" value="<?= set_value('newsShortDesc') ?>">
                                            <?php echo form_error('newsShortDesc'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($controller_config['disable_news_contact'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="newsContact">Contact</label>
                                            <textarea class="form-control ckeditor" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?> id="newsContact" placeholder="Contact" name="newsContact"><?= set_value('newsContact') ?></textarea>
                                            <?php echo form_error('newsContact'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_news_location'] != TRUE) : ?>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="newsLocation">Location</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="newsLocation" placeholder="Location" name="newsLocation" value="<?= set_value('newsLocation') ?>">
                                            <?php echo form_error('newsLocation'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_news_published_at'] != TRUE) : ?>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="newsPublishedAt">Publishing Date <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control dateTimePicker <?= $current_language->direction == 'rtl' ? 'text-right' : '' ?>" id="newsPublishedAt" placeholder="Published At" name="newsPublishedAt" value="<?= set_value('newsPublishedAt') ?>">
                                            <?php echo form_error('newsPublishedAt'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_news_link'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="newsLink">Link</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="newsLink" placeholder="Link" name="newsLink" value="<?= set_value('newsLink') ?>">
                                            <?php echo form_error('newsLink'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_news_save_draft'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="newsStatus">Status</label>
                                            <select class="custom-select" id="status" name="newsStatus">
                                                <option value="P" <?= set_value('newsStatus') == 'P' ? 'selected' : '' ?>>Open
                                                </option>
                                                <option value="D" <?= set_value('newsStatus') == 'D' ? 'selected' : '' ?>>
                                                    Close
                                                </option>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_news_cover_image'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="newsCoverImg">Description Image</label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="newsCoverImg" id="newsCoverImg" accept=".png,.jpg,.jpeg">
                                                <label for="newsCoverImg" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <div id="newsCoverImgError" class="error-text"><?= $newsCoverImgError ?></div>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label for="" class="text-danger fw-light"><i>*<?= $cover_img_note ?>*</i></label>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_news_brand_image'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="newsBrandImg">Secondary Image</label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="newsBrandImg" id="newsBrandImg" accept=".png,.jpg,.jpeg">
                                                <label for="newsBrandImg" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <div id="newsBrandImgError" class="error-text"><?= $newsBrandImgError ?></div>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label for="" class="text-danger fw-light"><i>*<?= $secondary_img_note ?>*</i></label>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_news_featured_images'] != TRUE) : ?>
                                        <div class="form-group col-sm-12" id="newsFeaturedFileContainer">
                                            <label for="newsMultimediaFile">Featured Images</label>
                                            <button type="button" class="btn btn-default" onclick="temp_add_featured()">
                                                <i class="fas fa-plus-circle"></i> Add File
                                            </button>
                                            <input type="hidden" name="newsFeaturedFilesCount" id="newsFeaturedFilesCount">
                                            <div class="card collapsed-card card-olive mt-3" style="display:none" id="featuredImagesContainer">
                                                <div class="card-header">
                                                    <h3 class="card-title">Uploaded Featured Images</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                            <i class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-12" id="featuredImagesGridView"></div>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_news_multimedia_images'] != TRUE) : ?>
                                        <div class="form-group col-sm-12" id="newsMultimediaFileContainer" style="<?= set_value('newsType') != 'M' ? 'display:none;' : '' ?>">
                                            <label for="newsMultimediaFile">Multimedia Images</label>
                                            <button type="button" class="btn btn-default" onclick="temp_add_multimedia()">
                                                <i class="fas fa-plus-circle"></i> Add File
                                            </button>
                                            <input type="hidden" name="newsMultimediaFilesCount" id="newsMultimediaFilesCount">
                                            <div class="card collapsed-card card-olive mt-3" style="display:none" id="multimediaImagesContainer">
                                                <div class="card-header">
                                                    <h3 class="card-title">Uploaded Multimedia Images</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                            <i class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-12" id="multimediaImagesGridView"></div>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_news_video_link'] != TRUE) : ?>
                                        <div class="col-sm-12" id="newsPressVideoFileContainer" style="<?= set_value('newsType') != 'PV' ? 'display:none;' : '' ?>">
                                            <div class="row">
                                                <div class="form-group col-md-12 col-sm-12" id="newsPressVideoLinkContainer">
                                                    <label for="newsPressVideoLink">Youtube Link </label>
                                                    <input type="text" class="form-control" id="newsPressVideoLink" placeholder="Press Video Link" name="newsPressVideoLink" value="<?= set_value('newsPressVideoLink') ?>">
                                                    <?php echo form_error('newsPressVideoLink'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_news_seo'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">SEO</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                            <i class="fas fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-sm-12">
                                                            <label for="newsSeoTitle">Title </label>
                                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="newsSeoTitle" placeholder="Title" name="newsSeoTitle" value="<?= set_value('newsSeoTitle') ?>">
                                                            <?php echo form_error('newsSeoTitle'); ?>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label for="newsSeoMetaKeywords">Meta Keywords</label>
                                                            <textarea class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="newsSeoMetaKeywords" placeholder="Meta Keywords" name="newsSeoMetaKeywords"><?= set_value('newsSeoMetaKeywords') ?></textarea>
                                                            <?php echo form_error('newsSeoMetaKeywords'); ?>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label for="newsSeoMetaDescription">Meta Description</label>
                                                            <textarea class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="newsSeoMetaDescription" placeholder="Meta Description" name="newsSeoMetaDescription"><?= set_value('newsSeoMetaDescription') ?></textarea>
                                                            <?php echo form_error('newsSeoMetaDescription'); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-sm-12 mt-4">
                                        <button type="button" class="btn btn-success float-right" onclick="news_form_submit()">Save
                                        </button>
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
<div class="modal fade" id="multimediaFileAddModal" tabindex="-1" role="dialog" aria-labelledby="multimediaFileAddModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="multimediaFileAddModalTitle">Add Multimedia File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="multimediaFileAddModalBody">
                <div class="form-group col-sm-12">
                    <label for="multimediaFileTitle">Title</label>
                    <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="multimediaFileTitle" placeholder="Title" name="multimediaFileTitle" value="">
                </div>
                <div class="form-group col-sm-12">
                    <label for="multimediaFileBrowse">Multimedia Image <a href="javascript:void(0)" class="text-info" data-toggle="tooltip" data-placement="top" title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i class="fa fa-info-circle"></i></a></label>
                    <div class="tower-file">
                        <input type="file" class="custom_fileInput" name="multimediaFileBrowse" id="multimediaFileBrowse" accept=".png,.jpg,.jpeg">
                        <label for="multimediaFileBrowse" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse </label>
                        <button type="button" class="tower-file-clear tower-file-button">
                            Clear
                        </button>
                    </div>
                    <div id="multimediaFileAddError" class="error-text"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-redirect="" id="submitMultimediaFileBtn" onclick="temp_add_multimedia_file()">Submit
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tempMultimediaFileEditModal" tabindex="-1" role="dialog" aria-labelledby="tempMultimediaFileEditModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tempMultimediaFileEditModalTitle">Edit File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="tempMultimediaFileEditModalBody">
                <input type="hidden" name="temp_multimedia_file_id" id="temp_multimedia_file_id">
                <div class="form-group col-sm-12">
                    <label for="tempMultimediaFileTitle">Title</label>
                    <input type="text" class="form-control" id="tempMultimediaFileTitle" placeholder="Title" name="tempMultimediaFileTitle" value="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="temp_submit_multimedia_file()">Submit
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tempDeleteMultimediaFileModal" tabindex="-1" role="dialog" aria-labelledby="tempDeleteMultimediaFileModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tempDeleteMultimediaFileModalTitle">Confirm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="alertModalBody">
                <input type="hidden" name="tempDeleteMultimediaFileId" id="tempDeleteMultimediaFileId">
                <p>Are you sure want to delete this file?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" data-redirect="" id="tempDeleteMultimediaConfirmBtn" onclick="temp_multimedia_file_delete_confirm()">Confirm
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="featuredFileAddModal" tabindex="-1" role="dialog" aria-labelledby="featuredFileAddModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="featuredFileAddModalTitle">Add Featured File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="featuredFileAddModalBody">
                <div class="form-group col-sm-12">
                    <label for="featuredFileTitle">Title</label>
                    <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="featuredFileTitle" placeholder="Title" name="featuredFileTitle" value="">
                </div>
                <div class="form-group col-sm-12">
                    <label for="featuredFileDesc">Description</label>
                    <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="featuredFileDesc" placeholder="Description" name="featuredFileDesc" value="">
                </div>
                <div class="form-group col-sm-12">
                    <label for="featuredFileBrowse">Featured Image <a href="javascript:void(0)" class="text-info" data-toggle="tooltip" data-placement="top" title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i class="fa fa-info-circle"></i></a></label>
                    <div class="tower-file">
                        <input type="file" class="custom_fileInput" name="featuredFileBrowse" id="featuredFileBrowse" accept=".png,.jpg,.jpeg">
                        <label for="featuredFileBrowse" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse </label>
                        <button type="button" class="tower-file-clear tower-file-button">
                            Clear
                        </button>
                    </div>
                    <div id="featuredFileAddError" class="error-text"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-redirect="" id="submitFeaturedFileBtn" onclick="temp_add_featured_file()">Submit
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tempFeaturedFileEditModal" tabindex="-1" role="dialog" aria-labelledby="tempFeaturedFileEditModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tempFeaturedFileEditModalTitle">Edit File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="tempFeaturedFileEditModalBody">
                <input type="hidden" name="temp_featured_file_id" id="temp_featured_file_id">
                <div class="form-group col-sm-12">
                    <label for="tempFeaturedFileTitle">Title</label>
                    <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="tempFeaturedFileTitle" placeholder="Title" name="tempFeaturedFileTitle" value="">
                </div>
                <div class="form-group col-sm-12">
                    <label for="tempFeaturedFileDesc">Description</label>
                    <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="tempFeaturedFileDesc" placeholder="Description" name="tempFeaturedFileDesc" value="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="temp_submit_featured_file()">Submit
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tempDeleteFeaturedFileModal" tabindex="-1" role="dialog" aria-labelledby="tempDeleteFeaturedFileModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tempDeleteFeaturedFileModalTitle">Confirm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="alertModalBody">
                <input type="hidden" name="tempDeleteFeaturedFileId" id="tempDeleteFeaturedFileId">
                <p>Are you sure want to delete this file?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" data-redirect="" id="tempDeleteFeaturedConfirmBtn" onclick="temp_featured_file_delete_confirm()">Confirm
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>