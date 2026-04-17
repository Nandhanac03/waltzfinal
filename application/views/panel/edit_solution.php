<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">solution</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/solution/all') ?>">solution</a></li>
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
                <?= $alert ?>
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Edit</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <!-- form start -->
                        <form role="form" method="post" action="<?= site_url('panel/solution/edit/' . $id . '/' . $current_language->id) ?>" enctype="multipart/form-data" id="solutionForm">
                            <!-- hidden-->
                            <input type="hidden" name="hid_lang_id" value="<?= $current_language->id ?>" id="hid_lang_id">
                            <input type="hidden" name="hid_solution_id" value="<?= $id ?>" id="hid_solution_id">
                            <?php if ($languages && count($languages) > 1 && $controller_config['disable_pr_languages'] != TRUE) : ?>
                                <ul class="nav nav-tabs mb-4" id="solution-content-below-tab" role="tablist">
                                    <?php
                                    $i = 1;
                                    foreach ($languages as $language) :
                                    ?>
                                        <li class="nav-item">
                                            <a class="nav-link <?= in_array($language->id, $solution_languages) && $language->id != $current_language->id ? ' bg-navy' : '' ?><?= $language->id == $current_language->id ? ' active bg-success' : '' ?>" href="<?= base_url('panel/solution/edit/' . $id . '/' . $language->id) ?>" role="tab" aria-selected="true"><?= $language->name ?></a>
                                        </li>
                                    <?php
                                    endforeach;
                                    ?>
                                </ul>
                            <?php endif; ?>
                            <div class="row">
                                <?php if ($controller_config['disable_pr_category'] !== TRUE) : ?>
                                    <div class="form-group col-sm-12 col-md-4">
                                        <label for="solutionCategory">Category<span class="text-danger">*</span></label>
                                        <select class="custom-select" id="solutionCategory" name="solutionCategory">
                                            <option value="">Select</option>
                                            <?php if ($solution_category) : ?>
                                                <?php foreach ($solution_category as $category) : ?>
                                                    <option value="<?= $category->id ?>"
                                                        <?= !empty($solution->category_id) && $solution->category_id == $category->id ? 'selected' : '' ?>>
                                                        <?= $category->title ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                        <?= form_error('solutionCategory'); ?>
                                    </div>
                                <?php endif; ?>

                                <!-- <div class="form-group col-sm-12">
                                    <label for="solutionName">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="solutionName" placeholder="Name" name="solutionName" value="<?= set_value('solutionName', empty($solution->title) ? '' : $solution->title) ?>">
                                    <?php echo form_error('solutionName'); ?>
                                </div> -->

                                <?php if ($controller_config['disable_pr_title'] != TRUE) : ?>
                                    <div class="form-group col-sm-12">
                                        <label for="solutionName">Name <span class="text-danger"></span></label>
                                        <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="solutionName" placeholder="Title" name="solutionName" value="<?= set_value('solutionName', empty($solution->title) ? '' : $solution->title) ?>" onchange="generate_slug_title(this, 'solutionSlugTitle')">
                                        <?php echo form_error('solutionName'); ?>
                                    </div>
                                    <?php endif; ?>

                                <!-- <?php //if ($controller_config['disable_pr_title'] != TRUE) : ?>
                                    <div class="form-group col-sm-12">
                                        <label for="solutionTitle">Title <span class="text-danger"></span></label>
                                        <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="solutionTitle" placeholder="Title" name="solutionTitle" value="<?= set_value('solutionTitle', empty($solution->title) ? '' : $solution->title) ?>" onchange="generate_slug_title(this, 'solutionSlugTitle')">
                                        <?php echo form_error('solutionTitle'); ?>
                                    </div>
                                <?php //endif; ?> -->
                                <?php if ($controller_config['disable_pr_slugtitle'] != TRUE) : ?>
                                    <div class="form-group col-sm-12">
                                        <label for="solutionSlugTitle">Slug Title <span class="text-danger"></span></label>
                                        <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="solutionSlugTitle" placeholder="Slug Title" name="solutionSlugTitle" value="<?= set_value('solutionSlugTitle', empty($solution->title_slug) ? '' : $solution->title_slug) ?>">
                                        <?php echo form_error('solutionSlugTitle'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_pr_subtitle'] != TRUE) : ?>
                                    <div class="form-group col-sm-12">
                                        <label for="solutionSubtitle">Subtitle</label>
                                        <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="solutionSubtitle" placeholder="Subtitle" name="solutionSubtitle" value="<?= set_value('solutionSubtitle', empty($solution->subtitle) ? '' : $solution->subtitle) ?>">
                                        <?php echo form_error('solutionSubtitle'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_pr_author'] !== TRUE) : ?>
                                    <div class="form-group col-sm-12">
                                        <label for="solutionAuthor">Author</label>
                                        <select class="custom-select" id="solutionAuthor" name="solutionAuthor">
                                            <option value="">Select</option>
                                            <?php if ($authors) : ?><?php foreach ($authors as $author) : ?>
                                            <option value="<?= $author->id ?>" <?= set_value('solutionAuthor', empty($solution->author) ? '' : $solution->author) == $author->id ? 'selected' : '' ?>><?= $author->name ?></option>
                                            <?php endforeach; ?><?php endif; ?>
                                        </select>

                                        <?php echo form_error('solutionAuthor'); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($controller_config['disable_pr_short_desc'] != TRUE) : ?>
                                    <div class="form-group col-sm-12">
                                        <label for="solutionShortDesc">Short Description</label>
                                        <textarea class="form-control ckeditor" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?> id="solutionShortDesc" placeholder="Short Description" name="solutionShortDesc"><?= set_value('solutionShortDesc', empty($solution->short_desc) ? '' : $solution->short_desc) ?></textarea>
                                        <?php echo form_error('solutionShortDesc'); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group col-sm-12">
                                    <label for="solutionDescription">Description</label>
                                    <textarea class="form-control ckeditor" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?> id="solutionDescription" placeholder="Description" name="solutionDescription"><?= set_value('solutionDescription', empty($solution->description) ? '' : $solution->description) ?></textarea>
                                    <?php echo form_error('solutionDescription'); ?>
                                </div>
                                <?php if ($controller_config['disable_pr_additonal_info'] !== TRUE) : ?>
                                    <div class="form-group col-sm-12">
                                        <label for="solutionAdditonalInfo">Additonal Information</label>
                                        <textarea class="form-control ckeditor" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?> id="solutionAdditonalInfo" placeholder="Additonal Information" name="solutionAdditonalInfo"><?= set_value('solutionAdditonalInfo', empty($solution->additonal_info) ? '' : $solution->additonal_info) ?></textarea>
                                        <?php echo form_error('solutionAdditonalInfo'); ?>
                                    </div>
                                <?php endif; ?>



                                <?php if ($controller_config['disable_pr_additonal_info_city'] !== TRUE) : ?>



                                <div class="container">
    <!-- Existing data rows -->
    <?php foreach ($solution_additional_info as $index => $info): ?>
    <div class="row mb-2" data-id="<?= $info->id ?>">
        <div class="form-group col-sm-5">
            <label for="cityName_<?= $index ?>">City Name</label>
            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                id="cityName_<?= $index ?>" placeholder="Enter City" name="cityName[]" 
                value="<?= htmlspecialchars($info->title) ?>">
            <?php echo form_error('cityName[]'); ?>
        </div>
        <div class="form-group col-sm-5">
            <label for="percentage_<?= $index ?>">Percentage</label>
            <input type="number" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                id="percentage_<?= $index ?>" placeholder="Enter Percentage" name="percentage[]" 
                value="<?= $info->count ?>" min="0" max="100">
            <?php echo form_error('percentage[]'); ?>
        </div>
        <div class="form-group col-sm-2 mt-4">
            <button type="button" class="btn btn-danger removeRow">X</button>
        </div>
        <input type="hidden" name="record_id[]" value="<?= $info->id ?>">
    </div>
    <?php endforeach; ?>

    <!-- Button to add more -->
    <div class="form-group col-sm-12 mt-4">
        <button type="button" class="btn btn-success" id="addRow">+ Add Another</button>
    </div>

    <!-- Container for dynamically added rows -->
    <div id="dynamicRows"></div>
</div>

<script>
document.getElementById('addRow').addEventListener('click', function() {
    let container = document.getElementById('dynamicRows');
    let timestamp = new Date().getTime();
    let newRow = `
        <div class="row mb-2" data-id="new_${timestamp}">
            <div class="form-group col-sm-5">
                <label for="cityName_${timestamp}">City Name</label>
                <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" 
                    id="cityName_${timestamp}" placeholder="Enter City" name="cityName[]">
            </div>
            <div class="form-group col-sm-5">
                <label for="percentage_${timestamp}">Percentage</label>
                <input type="number" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" 
                    id="percentage_${timestamp}" placeholder="Enter Percentage" name="percentage[]" min="0" max="100">
            </div>
            <div class="form-group col-sm-2 mt-4">
                <button type="button" class="btn btn-danger removeRow">X</button>
            </div>
            <input type="hidden" name="record_id[]" value="new">
        </div>
    `;
    container.insertAdjacentHTML('beforeend', newRow);
});

// Remove row
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('removeRow')) {
        e.target.closest('.row').remove();
    }
});
</script>


<?php endif; ?>



                                

                                <?php if ($controller_config['disable_pr_cover_img'] !== TRUE) : ?>
                                    <div class="form-group col-sm-12">
                                        <label for="solutionCoverImg">Cover Image</label>
                                        <div class="tower-file">
                                            <input type="file" class="custom_fileInput" name="solutionCoverImg" id="solutionCoverImg" accept=".png,.jpg,.jpeg">
                                            <label for="solutionCoverImg" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse </label>
                                            <button type="button" class="tower-file-clear tower-file-button">
                                                Clear
                                            </button>
                                        </div>
                                        <?= form_error('solutionCoverImg') ?>
                                        <div id="solutionCoverImgError" class="error-text"><?= $solutionCoverImgError ?></div>
                                    </div>
                                    <?php if (!empty($solution->cover_img)) : ?>
                                        <div class="col-sm-12">
                                            <div class="file-img-container">
                                                <div class="file-img-container-option">
                                                    <a href="javascript:void(0)" class="file_edit_btn trigger_alert_modal" data-title="Confirm" data-desc="Are you sure want to delete this?" data-redirect="<?= base_url('panel/solution/delete_cover_img/' . $solution->id . '/' . $solution->language) ?>"><i class="fas fa-trash"></i> </a>
                                                </div>
                                                <img src="<?= base_url('assets/uploads/solution/thumb_' . $solution->cover_img) ?>" class="img-fluid" />
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <div class="form-group col-sm-12">
                                    <label for="" class="text-danger"><i>* Image dimension should be 690 x 1280px (Width x Height) and less than 100kb in size are recommended. Image types supported include jpg, jpeg and png. *</i></label>
                                </div>
                                <?php if ($controller_config['disable_pr_back_cover_img'] !== TRUE) : ?>
                                    <div class="form-group col-sm-12">
                                        <label for="solutionCoverImg">Back Cover Image <a href="javascript:void(0)" class="text-info" data-toggle="tooltip" data-placement="top" title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i class="fa fa-info-circle"></i></a></label>
                                        <div class="tower-file">
                                            <input type="file" class="custom_fileInput" name="solutionBackCoverImg" id="solutionBackCoverImg" accept=".png,.jpg,.jpeg">
                                            <label for="solutionBackCoverImg" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse </label>
                                            <button type="button" class="tower-file-clear tower-file-button">
                                                Clear
                                            </button>
                                        </div>
                                        <?= form_error('solutionBackCoverImg') ?>
                                        <div id="solutionCoverImgError" class="error-text"><?= $solutionBackCoverImgError ?></div>
                                    </div>
                                    <?php if (!empty($solution->additional_img)) : ?>
                                        <div class="col-sm-12">
                                            <div class="file-img-container">
                                                <div class="file-img-container-option">
                                                    <a href="javascript:void(0)" class="file_edit_btn trigger_alert_modal" data-title="Confirm" data-desc="Are you sure want to delete this?" data-redirect="<?= base_url('panel/solution/delete_back_cover_img/' . $solution->id . '/' . $solution->language) ?>"><i class="fas fa-trash"></i> </a>
                                                </div>
                                                <img src="<?= base_url('assets/uploads/solution/thumb_' . $solution->additional_img) ?>" class="img-fluid" />
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if ($controller_config['disable_pr_document'] !== TRUE) : ?>
                                    <div class="form-group col-sm-12">
                                        <label for="solutionDocumentFile">Documents <a href="javascript:void(0)" class="text-info" data-toggle="tooltip" data-placement="top" title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i class="fa fa-info-circle"></i></a></label>
                                        <div class="tower-file">
                                            <input type="file" class="custom_fileInput" multiple name="solutionDocumentFile[]" id="solutionDocumentFile" accept=".pdf">
                                            <label for="solutionDocumentFile" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse </label>
                                            <button type="button" class="tower-file-clear tower-file-button">
                                                Clear
                                            </button>
                                        </div>
                                        <?php if ($solutionDocumentError) { ?>
                                            <div id="solutionDocumentError" class="error-text">

                                                <?= $solutionDocumentError[0]['error_message'] ?>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <?php if (!empty($solution_documents)) : $i = 1; ?>
                                        <div class="col-sm-12 col-md-4">
                                            <table class="table table-bordered table-sm">
                                                <thead>
                                                    <tr>
                                                        <th colspan="2" class="text-center">Uploaded Doucuments</th>
                                                    </tr>
                                                </thead>
                                                <!-- <tbody>
                                                    <?php foreach ($solution_documents as $solution_document) : ?>
                                                        <tr>
                                                            <td>
                                                                <a href="<?= base_url('assets/uploads/document/' . $solution_document->file) ?>" target="_blank">Document <?= $i ?></a>
                                                            </td>
                                                            <td align="center"><a href="<?= base_url('panel/solution/delete_solution_document/' . $solution_document->solution_id . '/' . $solution_document->id) ?>" class="text-danger" title="Delete"><i class="fas fa-trash"></i></a></td>
                                                        </tr>
                                                    <?php
                                                        $i++;
                                                    endforeach;
                                                    ?>
                                                </tbody> -->
                                                <tbody>
                                                    <?php foreach ($solution_documents as $solution_document) : ?>
                                                        <tr id="doc-<?= $solution_document->id ?>">
                                                            <td>

                                                                <a href="<?= base_url('assets/uploads/document/' . $solution_document->file) ?>" target="_blank" class="ml-2">
                                                                    <i class="fas fa-file-alt fa-2x"></i>
                                                                </a>
                                                            </td>
                                                            <td> <input type="text"
                                                                    class="form-control doc-title-input"
                                                                    data-id="<?= $solution_document->id ?>"
                                                                    value="<?= htmlspecialchars($solution_document->title ?? 'Document ' . $i) ?>">
                                                            </td>
                                                            <td align="center">
                                                                <a href="<?= base_url('panel/solution/delete_solution_document/' . $solution_document->solution_id . '/' . $solution_document->id) ?>"
                                                                    class="text-danger" title="Delete">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <?php $i++; ?>
                                                    <?php endforeach; ?>
                                                </tbody>

                                            </table>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>


                                <?php if ($controller_config['disable_pr_images'] !== TRUE) : ?>
                                    <div class="form-group col-sm-12" id="solutionsolutionFileContainer">
                                        <label for="solutionsolutionFile">solution Images</label>
                                        <button type="button" class="btn btn-default" onclick="solution_update_modal_show()">
                                            <i class="fas fa-plus-circle"></i> Add File
                                        </button>
                                        <div class="card collapsed-card card-olive mt-3" style="<?= !$solution_images ? 'display:none' : '' ?>" id="solutionImagesContainer">
                                            <div class="card-header">
                                                <h3 class="card-title">Uploaded solution Images</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                        <i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-12" id="solutionImagesGridView">
                                                        <?php if ($solution_images) : foreach ($solution_images as $solution_image) : ?>
                                                                <div class="file-img-container">
                                                                    <div class="file-img-container-option">
                                                                        <a href="javascript:void(0)" class="file_edit_btn" title="Delete" onclick="solution_file_delete('<?= $solution_image->id ?>')"><i class="fas fa-trash"></i> </a>
                                                                        <a href="<?= base_url('panel/solution/edit_file/' . $solution_image->solution_id . '/' . $solution_image->id) ?>" class="file_edit_btn" title="Edit" data-file-title="<?= $solution_image->title ?>"><i class="fas fa-edit"></i> </a>
                                                                    </div>
                                                                    <img src="<?= base_url('assets/uploads/solution/thumb_' . $solution_image->file) ?>" class="img-fluid" />
                                                                    <div class="file-img-title"><span title="<?= $solution_image->title ?>"><?= $solution_image->title ?: '--' ?></span>
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


                                    <div class="form-group col-sm-12">
                                        <label for="" class="text-danger"><i>* Image dimension should be 300 x 300px (Width x Height) and less than 100kb in size are recommended. Image types supported include jpg, jpeg and png. *</i></label>
                                    </div>
                                <?php endif; ?>
                                <?php if ($controller_config['disable_pr_status'] !== TRUE) : ?>
                                    <div class="form-group col-sm-12 col-md-4">
                                        <label for="solutionStatus">Status<span class="text-danger">*</span></label>
                                        <select class="custom-select" id="solutionStatus" name="solutionStatus">
                                            <option value='Y' <?= $solution->active == '1' ? 'selected' : '' ?>>
                                                Active
                                            </option>
                                            <option value='N' <?= $solution->active != '1' ? 'selected' : '' ?>>
                                                Inactive
                                            </option>
                                        </select>
                                        <?php echo form_error('solutionStatus'); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($controller_config['disable_pr_note'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="solutionNote">Note</label>
                                            <textarea class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="solutionNote" placeholder="Note" name="solutionNote"><?= set_value('solutionNote', empty($solution->note) ? '' : $solution->note) ?></textarea>
                                            <?php echo form_error('solutionNote'); ?>
                                        </div>
                                    <?php endif; ?>

                                <div class="col-sm-12 mt-4">
                                    <button type="submit" class="btn btn-success float-right">Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<div class="modal fade" id="solutionFileUpdateModal" tabindex="-1" role="dialog" aria-labelledby="solutionFileUpdateModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?= base_url('panel/solution/ajax_add_solution_file/' . $id . '/' . $lang) ?>" method="post" id="solutionFileUpdateModalForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="solutionFileUpdateModalTitle">Add solution File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="solutionFileUpdateModalBody">
                    <div class="form-group col-sm-12">
                        <label for="solutionFileUpdateTitle">Title</label>
                        <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="solutionFileUpdateTitle" placeholder="Title" name="solutionFileUpdateTitle" value="">
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="solutionFileUpdateBrowse">solution Image <a href="javascript:void(0)" class="text-info" data-toggle="tooltip" data-placement="top" title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i class="fa fa-info-circle"></i></a></label>
                        <div class="tower-file">
                            <input type="file" class="custom_fileInput" name="solutionFileUpdateBrowse" id="solutionFileUpdateBrowse" accept=".png,.jpg,.jpeg">
                            <label for="solutionFileUpdateBrowse" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse </label>
                            <button type="button" class="tower-file-clear tower-file-button">
                                Clear
                            </button>
                        </div>
                        <div id="solutionFileUpdateError" class="error-text"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-redirect="" id="submitsolutionFileUpdateBtn">
                        Submit
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="solutionFileEditModal" tabindex="-1" role="dialog" aria-labelledby="solutionFileEditModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?= base_url('panel/solution/ajax_solution_file_description/' . $id . '/' . $lang) ?>" method="post" id="solutionFileEditModalForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="solutionFileEditModalTitle">Edit File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="solutionFileEditModalBody">
                    <input type="hidden" name="solution_file_id" id="solution_file_id">
                    <div class="form-group col-sm-12">
                        <label for="solutionFileTitle">Title</label>
                        <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="solutionFileTitle" placeholder="Title" name="solutionFileTitle" value="">
                        <div id="solutionFileEditError" class="error-text"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-redirect="" id="solutionFileEditModalBtn">
                        Submit
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="deletesolutionFileModal" tabindex="-1" role="dialog" aria-labelledby="deletesolutionFileModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?= base_url('panel/solution/ajax_delete_solution_file/' . $id . '/' . $lang) ?>" method="post" id="deletesolutionFileModalForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletesolutionFileModalTitle">Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="deletesolutionFileModalBody">
                    <input type="hidden" name="deletesolutionFileId" id="deletesolutionFileId">
                    <p>Are you sure want to delete this file?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-redirect="" id="deletesolutionConfirmBtn">
                        Confirm
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
<script>
    $('#solutionFileUpdateModalForm').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false, // required for file upload
            contentType: false, // required for file upload
            success: function(response) {
                console.log("Upload success", response);

                // Close modal
                $('#solutionFileUpdateModal').modal('hide');

                // Reload after 3 seconds (3000ms)
                location.reload();
            },
            error: function(xhr) {
                console.error("Upload failed", xhr.responseText);
            }
        });
    });

    $('#deletesolutionFileModalForm').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log("File deleted successfully", response);

                $('#deletesolutionFileModal').modal('hide');

                location.reload();
            },
            error: function(xhr) {
                console.error("Delete failed", xhr.responseText);
            }
        });
    });

    $(document).on('change', '.doc-title-input', function() {
        let input = $(this);
        let docId = input.data('id');
        let newTitle = input.val();

        // reset states first
        input.removeClass("is-valid is-invalid");

        $.ajax({
            url: "<?= base_url('panel/solution/ajax_update_solution_document_title') ?>",
            type: "POST",
            data: {
                doc_id: docId,
                title: newTitle
            },
            success: function(response) {
                if (response.success) {
                    input.addClass("is-valid");
                } else {
                    input.addClass("is-invalid");
                }
                setTimeout(() => input.removeClass("is-valid is-invalid"), 2000);
            },
            error: function() {
                input.addClass("is-invalid");
                setTimeout(() => input.removeClass("is-invalid"), 2000);
            }
        });
    });

    //function to show the solution file add modal
    function solution_update_modal_show() {
        $('#solutionFileUpdateBrowse').val('').trigger('change');
        $('#solutionFileUpdateTitle').val('');
        $('#solutionFileUpdateError').html('');
        $('#solutionFileUpdateModal').modal('show');
    }

    //ajax form submit to submit the solution file
    $('#solutionFileUpdateModalForm').ajaxForm({
        success: function(data) {
            if (data == true) {
                get_solution_files();
                $('#solutionFileUpdateBrowse').val('').trigger('change');
                $('#solutionFileUpdateTitle').val('');
                $('#solutionFileUpdateError').html('');
                $('#solutionFileUpdateModal').modal('hide');
            } else {
                $('#solutionFileUpdateError').html(data);
            }
        }
    });

    //function to get all the solution files
    function get_solution_files() {
        var solution_id = $('#hid_solution_id').val();
        var language_id = $('#hid_lang_id').val();
        $.ajax({
            url: BASE_URL + 'panel/solution/ajax_get_solution_files',
            type: 'POST',
            data: {
                solution_id: solution_id,
                language_id: language_id
            },
            success: function(data) {
                if (data.trim().length > 0) {
                    $('#solutionImagesContainer').show();
                    $('#solutionImagesGridView').html(data);
                } else {
                    $('#solutionImagesGridView').html('');
                    $('#solutionImagesContainer').hide();
                }
            }
        })
    }

    //function to edit the solution file description
    function solution_file_edit(e, file_id) {
        $('#solutionFileTitle').val('');
        $('#solutionFileEditError').html('');
        var title = $(e).data('file-title');
        if (title) {
            $('#solutionFileTitle').val(title);
        }
        $('#solution_file_id').val(file_id);
        $('#solutionFileEditModal').modal('show');
    }

    //function to edit solution file description
    $('#solutionFileEditModalForm').ajaxForm({
        success: function(data) {
            if (data == true) {
                $('#solution_file_id').val('');
                $('#solutionFileTitle').val('');
                $('#solutionFileEditModal').modal('hide');
                get_solution_files();
            } else {
                $('#solutionFileEditError').html(data);
            }
        }
    });

    //function to show modal to confirm delete file
    function solution_file_delete(file_id) {
        if (file_id > 0) {
            $('#deletesolutionFileId').val(file_id);
            $('#deletesolutionFileModal').modal('show');
        }
    }

    //ajax from confirm submit to delete the solution file
    $('#deletesolutionFileModalForm').ajaxForm({
        success: function(data) {
            if (data == true) {
                $('#deletesolutionFileId').val('');
                $('#deletesolutionFileModal').modal('hide');
                get_solution_files();
            }
        }
    });

    //function to show the modal to add solution file
    function temp_add_solution() {
        $('#solutionFileBrowse').val('').trigger('change');
        $('#solutionFileTitle').val('');
        $('#solutionFileAddError').html('');
        $('#solutionFileAddModal').modal('show');
    }

    //function to temporarily add solution file in hidden file input and description in hidden input and preview the file
    function temp_add_solution_file() {
        $('#solutionFileAddError').html('');
        $('#solutionFileAddError').hide();
        var fileLength = $('#solutionFileBrowse')[0].files.length;
        if (fileLength > 0) {
            var solutionFileTitle = $('#solutionFileTitle').val();
            var hiddenFileLength = +($('.hiddensolutionFile').length) + 1;
            $('#solutionFilesCount').val(hiddenFileLength);
            $('#solutionFileContainer').append('<input type="file" id="solutionFile_' + hiddenFileLength + '" name="solutionFile_' + hiddenFileLength + '" class="hiddensolutionFile" style="display: none;">');
            $('#solutionFileContainer').append('<input type="hidden" id="solutionFileTitle_' + hiddenFileLength + '" name="solutionFileTitle_' + hiddenFileLength + '" class="hiddensolutionFileTitle" value="' + solutionFileTitle + '">');
            $('#solutionFile_' + hiddenFileLength).prop('files', $('#solutionFileBrowse')[0].files);
            $('#solutionFile_' + hiddenFileLength).trigger('change');
            if ($('#solutionFile_' + hiddenFileLength)[0].files.length > 0) {
                var reader = new FileReader();
                reader.onload = function(el) {
                    var append_img = '<div class="file-img-container" id="solutionFile_' + hiddenFileLength + '_img_container">' +
                        '<div class="file-img-container-option">' +
                        '<a href="javascript:void(0)" ' +
                        'class="file_edit_btn" title="Delete" ' +
                        'onclick="temp_solution_file_delete(' + hiddenFileLength + ')">' +
                        '<i	class="fas fa-trash"></i> </a>' +
                        '<a href="javascript:void(0)" class="file_edit_btn" title="Edit" ' +
                        ' onclick="temp_edit_solution_file_btn(' + hiddenFileLength + ')"><i	class="fas fa-edit"></i> </a></div>' +
                        '<img src="' + el.target.result + '" class="img-fluid" id="solutionFile_' + hiddenFileLength + '_img"/>';
                    if (solutionFileTitle.length > 0) {
                        append_img += '<div class="file-img-title" id="solutionFile_' + hiddenFileLength + '_img_title"><span title="">' + solutionFileTitle + '</span></div>';
                    } else {
                        append_img += '<div class="file-img-title" id="solutionFile_' + hiddenFileLength + '_img_title"><span title="">--</span></div>';
                    }
                    append_img += '</div>';
                    $('#solutionImagesGridView').append(append_img);
                    $('#solutionImagesContainer').show();
                }
                reader.readAsDataURL($('#solutionFile_' + hiddenFileLength)[0].files[0]);
            }
            $('#solutionFileBrowse').val('').trigger('change');
            $('#solutionFileTitle').val('');
            $('#solutionFileAddModal').modal('hide');
        } else {
            $('#solutionFileAddError').html('File required.');
            $('#solutionFileAddError').show();
        }
    }

    //function to edit temporarily added solution file description
    function temp_edit_solution_file_btn(temp_id) {
        $('#temp_solution_file_id').val(temp_id);
        var title = $("#solutionFileTitle_" + temp_id).val();
        $('#tempsolutionFileTitle').val(title);
        $('#tempsolutionFileEditModal').modal('show');
    }

    //function to temporarily edit the solution file description
    function temp_submit_solution_file() {
        var temp_id = $('#temp_solution_file_id').val();
        var title = $("#tempsolutionFileTitle").val();
        $("#solutionFileTitle_" + temp_id).val(title);
        $("#solutionFile_" + temp_id + "_img_title span").html(title);
        $("#solutionFile_" + temp_id + "_img_title span").attr('title', title);
        $('#tempsolutionFileEditModal').modal('hide');
    }

    //function to show confirm modal to  delete temporarily added solution file
    function temp_solution_file_delete(file_id) {
        if (file_id > 0) {
            $('#tempDeletesolutionFileId').val(file_id);
            $('#tempDeletesolutionFileModal').modal('show');
        }
    }

    //function to delete temporarily added solution file
    function temp_solution_file_delete_confirm() {
        var temp_id = $('#tempDeletesolutionFileId').val();
        if (temp_id > 0) {
            $("#solutionFile_" + temp_id).val('');
            $("#solutionFileTitle_" + temp_id).val('');
            $("#solutionFile_" + temp_id + "_img_container").html('');
            $("#solutionFile_" + temp_id + "_img_container").hide();
            $('#tempDeletesolutionFileId').val('');
            $('#tempDeletesolutionFileModal').modal('hide');
        }
    }
</script>