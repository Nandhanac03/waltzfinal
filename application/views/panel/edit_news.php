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
                        <form role="form" method="post" action="<?= site_url('panel/news/edit/' . $newsroom_id . '/' . $language_id) ?>" enctype="multipart/form-data" id="newsForm">
                            <!-- hidden values -->
                            <input type="hidden" name="newsroom_id" id="newsroom_id" value="<?= $newsroom_id ?>">
                            <input type="hidden" name="language_id" id="language_id" value="<?= $language_id ?>">
                            <!-- <input type="hidden" name="newsStatus" id="newsStatus"> -->
                            <div class="card-body">
                                <?php if ($languages && count($languages) > 1 && $controller_config['disable_news_languages'] != TRUE) : ?>
                                    <ul class="nav nav-tabs mb-4" id="news-content-below-tab" role="tablist">
                                        <?php
                                        $i = 1;
                                        foreach ($languages as $language) :
                                        ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?= in_array($language->id, $news_languages) && $language->id != $current_language->id ? ' bg-navy' : '' ?><?= $language->id == $current_language->id ? ' active bg-success' : '' ?>" href="<?= base_url('panel/news/edit/' . $newsroom_id . '/' . $language->id) ?>" role="tab" aria-selected="true"><?= $language->name ?></a>
                                            </li>
                                        <?php
                                        endforeach;
                                        ?>
                                    </ul>
                                <?php endif; ?>
                                <div class="row">
                                    <?php if ($controller_config['disable_news_type'] != TRUE) : ?>
                                        <div class="form-group col-sm-12 col-md-6" style="<?= $language_id != 1 ? 'display:none;' : '' ?>">
                                            <label for="newsType">News Type <span class="text-danger">*</span></label>
                                            <select class="custom-select" id="newsType" name="newsType" onchange="newsTypeChanged(this)">
                                                <option value="">Select</option>
                                                <option value="N" <?= set_value('newsType', $newsroom->type) == 'N' ? 'selected' : '' ?>>
                                                    Newsroom
                                                </option>
                                                <option value="M" <?= set_value('newsType', $newsroom->type) == 'M' ? 'selected' : '' ?>>
                                                    Multimedia Newsroom
                                                </option>
                                                <option value="PV" <?= set_value('newsType', $newsroom->type) == 'PV' ? 'selected' : '' ?>>
                                                    Press Video Newsroom
                                                </option>
                                            </select>
                                            <?php echo form_error('newsType'); ?>
                                        </div>
                                    <?php else : ?>
                                        <input type="hidden" name="newsType" id="newsType" value="1" onchange="newsTypeChanged(this)">
                                    <?php endif; ?>
                                    <div class="form-group col-sm-12">
                                        <label for="newsTitle">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="newsTitle" placeholder="Title" name="newsTitle" value="<?= set_value('newsTitle', empty($news->title) ? '' : $news->title) ?>" onchange="generate_slug_title(this, 'newsSlugTitle')">
                                        <?php echo form_error('newsTitle'); ?>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="newsSlugTitle">Slug Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="newsSlugTitle" placeholder="Slug Title" name="newsSlugTitle" value="<?= set_value('newsSlugTitle', empty($news->title_slug) ? '' : $news->title_slug) ?>">
                                        <?php echo form_error('newsSlugTitle'); ?>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="newsContent">Short Description</label>
                                        <textarea class="form-control ckeditor" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?> id="newsDescription" placeholder="Description" name="newsDescription"><?= set_value('newsDescription', empty($news->description) ? '' : $news->description) ?></textarea>
                                        <?php echo form_error('newsDescription'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_news_subtitle'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="newsSubtitle">Hyperlink</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="newsSubtitle" placeholder="Redirection url" name="newsSubtitle" value="<?= set_value('newsSubtitle', empty($news->subtitle) ? '' : $news->subtitle) ?>">
                                            <?php echo form_error('newsSubtitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_news_short_desc'] != TRUE) : ?>
                                        <div class="form-group col-sm-12" style="display: none;">
                                            <label for="newsShortDesc">Job Description Link</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="newsShortDesc" placeholder="Job Description Link" name="newsShortDesc" value="<?= set_value('newsShortDesc', empty($news->short_desc) ? '' : $news->short_desc) ?>">
                                            <?php echo form_error('newsShortDesc'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($controller_config['disable_news_contact'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="newsContact">Contact</label>
                                            <textarea class="form-control ckeditor" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?> id="newsContact" placeholder="Contact" name="newsContact"><?= set_value('newsContact', empty($news->contact) ? '' : $news->contact) ?></textarea>
                                            <?php echo form_error('newsContact'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_news_location'] != TRUE) : ?>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="newsLocation">Location</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="newsLocation" placeholder="Location" name="newsLocation" value="<?= set_value('newsLocation', empty($news->location) ? '' : $news->location) ?>">
                                            <?php echo form_error('newsLocation'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_news_published_at'] != TRUE) : ?>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="newsPublishedAt">Publishing Date <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control dateTimePicker <?= $current_language->direction == 'rtl' ? 'text-right' : '' ?>" id="newsPublishedAt" placeholder="Published At" name="newsPublishedAt" value="<?= set_value('newsPublishedAt', empty($news->published_at) ? '' : date('d/m/Y H:i', $news->published_at)) ?>">
                                            <?php echo form_error('newsPublishedAt'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_news_link'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="newsLink">Link</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="newsLink" placeholder="Link" name="newsLink" value="<?= set_value('newsLink', empty($news->link) ? '' : $news->link) ?>">
                                            <?php echo form_error('newsLink'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_news_save_draft'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="newsStatus">Status</label>
                                            <select class="custom-select <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="newsStatus" name="newsStatus">
                                                <option value="P" <?= set_value('newsStatus', empty($news->status) ? '' : $news->status) == 'P' ? 'selected' : '' ?>>Open
                                                </option>
                                                <option value="D" <?= set_value('newsStatus', empty($news->status) ? '' : $news->status) == 'D' ? 'selected' : '' ?>>
                                                    Closed
                                                </option>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_news_status'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12 col-md-4">
                                            <label for="newsStatus">Status<span class="text-danger">*</span></label>
                                            <select class="custom-select" id="newsStatus" name="newsStatus">
                                                <option value="">Select</option>
                                                <option value='1' <?= $news->active == 1 ? 'selected' : '' ?>>
                                                    Active
                                                </option>
                                                <option value='0' <?= $news->active != 1 ? 'selected' : '' ?>>
                                                    Inactive
                                                </option>
                                            </select>
                                            <?php echo form_error('newsStatus'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_news_cover_image'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="newsCoverImg">Cover Image </label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="newsCoverImg" id="newsCoverImg" accept=".png,.jpg,.jpeg">
                                                <label for="newsCoverImg" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <div id="newsCoverImgError" class="error-text"><?= $newsCoverImgError ?></div>
                                        </div>
                                        <?php if (!empty($news->news_cover)) : ?>
                                            <div class="col-sm-12">
                                                <div class="file-img-container">
                                                    <div class="file-img-container-option">
                                                        <a href="javascript:void(0)" class="file_edit_btn trigger_alert_modal" data-title="Confirm" data-desc="Are you sure want to delete this?" data-redirect="<?= base_url('panel/news/delete_cover_img/' . $news->id . '/' . $news->language) ?>"><i class="fas fa-trash"></i> </a>
                                                    </div>
                                                    <img src="<?= base_url('assets/uploads/news/thumb_' . $news->news_cover) ?>" class="img-fluid" />
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="form-group col-sm-12">
                                            <label for="" class="text-danger fw-light"><i>*<?= $cover_img_note ?>*</i></label>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_news_brand_image'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="newsBrandImg">Secondary Image </label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="newsBrandImg" id="newsBrandImg" accept=".png,.jpg,.jpeg">
                                                <label for="newsBrandImg" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <div id="newsBrandImgError" class="error-text"><?= $newsBrandImgError ?></div>
                                        </div>

                                        <?php if (!empty($news->secondary_img)) : ?>
                                            <div class="col-sm-12">
                                                <div class="file-img-container">
                                                    <div class="file-img-container-option">
                                                        <a href="javascript:void(0)" class="file_edit_btn trigger_alert_modal" data-title="Confirm" data-desc="Are you sure want to delete this?" data-redirect="<?= base_url('panel/news/delete_brand_img/' . $news->id . '/' . $news->language) ?>"><i class="fas fa-trash"></i> </a>
                                                    </div>
                                                    <img src="<?= base_url('assets/uploads/news/thumb_' . $news->secondary_img) ?>" class="img-fluid" />
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="form-group col-sm-12">
                                            <label for="" class="text-danger fw-light"><i>*<?= $secondary_img_note ?>*</i></label>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($controller_config['disable_news_featured_images'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="newsFeaturedImage">Featured Image</label>
                                            <button type="button" class="btn btn-default" onclick="featured_update_modal_show()">
                                                <i class="fas fa-plus-circle"></i> Add File
                                            </button>
                                            <div class="card collapsed-card card-gray mt-3" style="<?= !$featured_images ? 'display:none' : '' ?>" id="featuredImagesContainer">
                                                <div class="card-header">
                                                    <h3 class="card-title">Uploaded Featured Images</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                            <i class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-12" id="featuredImagesGridView">
                                                            <?php if ($featured_images) : foreach ($featured_images as $featured_image) : ?>
                                                                    <div class="file-img-container">
                                                                        <div class="file-img-container-option">
                                                                            <a href="javascript:void(0)" class="file_edit_btn" title="Delete" onclick="featured_file_delete('<?= $featured_image->id ?>')"><i class="fas fa-trash"></i> </a> <a href="javascript:void(0)" class="file_edit_btn" title="Edit" data-file-title="<?= $featured_image->title ?>" data-file-description="<?= $featured_image->description ?>" onclick="featured_file_edit(this, '<?= $featured_image->id ?>')"><i class="fas fa-edit"></i> </a>
                                                                        </div>
                                                                        <img src="<?= base_url('assets/uploads/news/thumb_' . $featured_image->file) ?>" class="img-fluid" />
                                                                        <div class="file-img-title"><span title="<?= $featured_image->title ?>"><?= $featured_image->title ?: '--' ?></span>
                                                                        </div>
                                                                    </div>
                                                            <?php
                                                                endforeach;
                                                            endif;
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_news_multimedia_images'] != TRUE) : ?>
                                        <div class="form-group col-sm-12" id="newsMultimediaFileContainer" style="<?= $newsroom->type !== 'M' ? 'display:none;' : '' ?>">
                                            <label for="newsMultimediaFile">Multimedia Images</label>
                                            <button type="button" class="btn btn-default" onclick="multimedia_update_modal_show()">
                                                <i class="fas fa-plus-circle"></i> Add File
                                            </button>
                                            <div class="card collapsed-card card-olive mt-3" style="<?= !$multimedia_images ? 'display:none' : '' ?>" id="multimediaImagesContainer">
                                                <div class="card-header">
                                                    <h3 class="card-title">Uploaded Multimedia Images</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                            <i class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-12" id="multimediaImagesGridView">
                                                            <?php if ($multimedia_images) : foreach ($multimedia_images as $multimedia_image) : ?>
                                                                    <div class="file-img-container">
                                                                        <div class="file-img-container-option">
                                                                            <a href="javascript:void(0)" class="file_edit_btn" title="Delete" onclick="multimedia_file_delete('<?= $multimedia_image->id ?>')"><i class="fas fa-trash"></i> </a> <a href="javascript:void(0)" class="file_edit_btn" title="Edit" data-file-title="<?= $multimedia_image->title ?>" onclick="multimedia_file_edit(this, '<?= $multimedia_image->id ?>')"><i class="fas fa-edit"></i> </a>
                                                                        </div>
                                                                        <img src="<?= base_url('assets/uploads/news/thumb_' . $multimedia_image->file) ?>" class="img-fluid" />
                                                                        <div class="file-img-title"><span title="<?= $multimedia_image->title ?>"><?= $multimedia_image->title ?: '--' ?></span>
                                                                        </div>
                                                                    </div>
                                                            <?php
                                                                endforeach;
                                                            endif;
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_news_video_link'] != TRUE) : ?>
                                        <div class="col-sm-12" id="newsPressVideoFileContainer" style="<?= $newsroom->type !== 'PV' ? 'display: none;' : '' ?>">
                                            <div class="row">
                                                <div class="form-group col-md-12 col-sm-12" id="newsPressVideoLinkContainer">
                                                    <label for="newsPressVideoLink">Youtube Link </label>
                                                    <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="newsPressVideoLink" placeholder="Press Video Link" name="newsPressVideoLink" value="<?= set_value('newsPressVideoLink', !empty($news_video_link->file) ? $news_video_link->file : '') ?>">
                                                    <?php echo form_error('newsPressVideoLink'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_news_seo'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <div class="card collapsed-card card-purple" id="newsSeoContainer">
                                                <div class="card-header">
                                                    <h3 class="card-title">SEO</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                            <i class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-sm-12">
                                                            <label for="newsSeoTitle">Title </label>
                                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="newsSeoTitle" placeholder="Title" name="newsSeoTitle" value="<?= set_value('newsSeoTitle', empty($news->seo_title) ? '' : $news->seo_title ?: '') ?>">
                                                            <?php echo form_error('newsSeoTitle'); ?>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label for="newsSeoMetaKeywords">Meta Keywords</label>
                                                            <textarea class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="newsSeoMetaKeywords" placeholder="Meta Keywords" name="newsSeoMetaKeywords"><?= set_value('newsSeoMetaKeywords', empty($news->seo_meta_keywords) ? '' : $news->seo_meta_keywords) ?></textarea>
                                                            <?php echo form_error('newsSeoMetaKeywords'); ?>
                                                        </div>
                                                        <div class="form-group col-sm-12">
                                                            <label for="newsSeoMetaDescription">Meta Description</label>
                                                            <textarea class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="newsSeoMetaDescription" placeholder="Meta Description" name="newsSeoMetaDescription"><?= set_value('newsSeoMetaDescription', empty($news->seo_meta_description) ? '' : $news->seo_meta_description) ?></textarea>
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
<div class="modal fade" id="multimediaFileUpdateModal" tabindex="-1" role="dialog" aria-labelledby="multimediaFileUpdateModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?= base_url('panel/news/ajax_add_multimedia_file/' . $newsroom_id . '/' . $language_id) ?>" method="post" id="multimediaFileUpdateModalForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="multimediaFileUpdateModalTitle">Add Multimedia File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="multimediaFileUpdateModalBody">
                    <div class="form-group col-sm-12">
                        <label for="multimediaFileUpdateTitle">Title</label>
                        <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="multimediaFileUpdateTitle" placeholder="Title" name="multimediaFileUpdateTitle" value="">
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="multimediaFileUpdateBrowse">Multimedia Image <a href="javascript:void(0)" class="text-info" data-toggle="tooltip" data-placement="top" title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i class="fa fa-info-circle"></i></a></label>
                        <div class="tower-file">
                            <input type="file" class="custom_fileInput" name="multimediaFileUpdateBrowse" id="multimediaFileUpdateBrowse" accept=".png,.jpg,.jpeg">
                            <label for="multimediaFileUpdateBrowse" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse </label>
                            <button type="button" class="tower-file-clear tower-file-button">
                                Clear
                            </button>
                        </div>
                        <div id="multimediaFileUpdateError" class="error-text"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-redirect="" id="submitMultimediaFileUpdateBtn">
                        Submit
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="multimediaFileEditModal" tabindex="-1" role="dialog" aria-labelledby="multimediaFileEditModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?= base_url('panel/news/ajax_multimedia_file_description/' . $newsroom_id . '/' . $language_id) ?>" method="post" id="multimediaFileEditModalForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="multimediaFileEditModalTitle">Edit File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="multimediaFileEditModalBody">
                    <input type="hidden" name="multimedia_file_id" id="multimedia_file_id">
                    <div class="form-group col-sm-12">
                        <label for="multimediaFileTitle">Title</label>
                        <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="multimediaFileTitle" placeholder="Title" name="multimediaFileTitle" value="">
                        <div id="multimediaFileEditError" class="error-text"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-redirect="" id="multimediaFileEditModalBtn">
                        Submit
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteMultimediaFileModal" tabindex="-1" role="dialog" aria-labelledby="deleteMultimediaFileModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?= base_url('panel/news/ajax_delete_multimedia_file/' . $newsroom_id . '/' . $language_id) ?>" method="post" id="deleteMultimediaFileModalForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteMultimediaFileModalTitle">Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="deleteMultimediaFileModalBody">
                    <input type="hidden" name="deleteMultimediaFileId" id="deleteMultimediaFileId">
                    <p>Are you sure want to delete this file?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-redirect="" id="deleteMultimediaConfirmBtn">
                        Confirm
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="featuredFileUpdateModal" tabindex="-1" role="dialog" aria-labelledby="featuredFileUpdateModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?= base_url('panel/news/ajax_add_featured_file/' . $newsroom_id . '/' . $language_id) ?>" method="post" id="featuredFileUpdateModalForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="featuredFileUpdateModalTitle">Add Featured File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="featuredFileUpdateModalBody">
                    <div class="form-group col-sm-12">
                        <label for="featuredFileUpdateTitle">Title</label>
                        <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="featuredFileUpdateTitle" placeholder="Title" name="featuredFileUpdateTitle" value="">
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="featuredFileUpdateDesc">Description</label>
                        <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="featuredFileUpdateDesc" placeholder="Description" name="featuredFileUpdateDesc" value="">
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="featuredFileUpdateBrowse">Featured Image <a href="javascript:void(0)" class="text-info" data-toggle="tooltip" data-placement="top" title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i class="fa fa-info-circle"></i></a></label>
                        <div class="tower-file">
                            <input type="file" class="custom_fileInput" name="featuredFileUpdateBrowse" id="featuredFileUpdateBrowse" accept=".png,.jpg,.jpeg">
                            <label for="featuredFileUpdateBrowse" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse </label>
                            <button type="button" class="tower-file-clear tower-file-button">
                                Clear
                            </button>
                        </div>
                        <div id="featuredFileUpdateError" class="error-text"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-redirect="" id="submitFeaturedFileUpdateBtn">
                        Submit
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="featuredFileEditModal" tabindex="-1" role="dialog" aria-labelledby="featuredFileEditModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?= base_url('panel/news/ajax_featured_file_description/' . $newsroom_id . '/' . $language_id) ?>" method="post" id="featuredFileEditModalForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="featuredFileEditModalTitle">Edit File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="featuredFileEditModalBody">
                    <input type="hidden" name="featured_file_id" id="featured_file_id">
                    <div class="form-group col-sm-12">
                        <label for="featuredFileTitle">Title</label>
                        <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="featuredFileTitle" placeholder="Title" name="featuredFileTitle" value="">
                        <div id="featuredFileEditError" class="error-text"></div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="featuredFileDesc">Description</label>
                        <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="featuredFileDesc" placeholder="Description" name="featuredFileDesc" value="">
                        <div id="featuredFileEditDescError" class="error-text"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-redirect="" id="featuredFileEditModalBtn">
                        Submit
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteFeaturedFileModal" tabindex="-1" role="dialog" aria-labelledby="deleteFeaturedFileModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?= base_url('panel/news/ajax_delete_featured_file/' . $newsroom_id . '/' . $language_id) ?>" method="post" id="deleteFeaturedFileModalForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteFeaturedFileModalTitle">Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="deleteFeaturedFileModalBody">
                    <input type="hidden" name="deleteFeaturedFileId" id="deleteFeaturedFileId">
                    <p>Are you sure want to delete this file?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-redirect="" id="deleteFeaturedConfirmBtn">
                        Confirm
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>