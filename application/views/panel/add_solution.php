<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Solution</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/solution/all') ?>">Solution</a></li>
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
                        <form role="form" method="post" action="<?= site_url('panel/solution/add') ?>" enctype="multipart/form-data" id="solutionForm">
                            <div class="card-body">
                                <div class="row">
                                    <?php if ($controller_config['disable_pr_category'] !== TRUE) : ?>
                                        <?php if ($solution_category) : ?>
                                            <div class="form-group col-sm-12">
                                                <label for="solutionCategory">Category<span class="text-danger">*</span></label>
                                                <select class="custom-select" id="solutionCategory" name="solutionCategory">
                                                    <option value="">Select</option>
                                                    <?php foreach ($solution_category as $category) : ?>
                                                        <option value="<?= $category->id ?>">
                                                            <?= $category->title ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?= form_error('solutionCategory'); ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>


                                    <!-- <div class="form-group col-sm-12">
                                        <label for="solutionName">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="solutionName" placeholder="Name" name="solutionName" value="<?= set_value('solutionName') ?>" onchange="generate_slug_title(this, 'solutionSlugTitle')">
                                        <?php echo form_error('solutionName'); ?>
                                    </div> -->
                                    <?php if ($controller_config['disable_pr_title'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="solutionName">Title <span class="text-danger"></span></label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="solutionName" placeholder="Title" name="solutionName" value="<?= set_value('solutionName') ?>" onchange="generate_slug_title(this, 'solutionSlugTitle')">
                                            <?php echo form_error('solutionName'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_slugtitle'] != TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="solutionSlugTitle">Slug Title <span class="text-danger"></span></label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="solutionSlugTitle" placeholder="Slug Title" name="solutionSlugTitle" value="<?= set_value('solutionSlugTitle') ?>">
                                            <?php echo form_error('solutionSlugTitle'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_subtitle'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="solutionSubtitle">Subtitle</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="solutionSubtitle" placeholder="Subtitle" name="solutionSubtitle" value="<?= set_value('solutionSubtitle') ?>">
                                            <?php echo form_error('solutionSubtitle'); ?>
                                        </div>
                                    <?php endif; ?>


                                    <?php if ($controller_config['disable_pr_short_desc'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="solutionShortDesc">Short Description</label>
                                            <textarea class="form-control ckeditor" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?> id="solutionShortDesc" placeholder="Short Description" name="solutionShortDesc"><?= set_value('solutionShortDesc') ?></textarea>
                                            <?php echo form_error('solutionShortDesc'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_description'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="solutionDescription">Description</label>
                                            <textarea class="form-control ckeditor" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?> id="solutionDescription" placeholder="Description" name="solutionDescription"><?= set_value('solutionDescription') ?></textarea>
                                            <?php echo form_error('solutionDescription'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($controller_config['disable_pr_additonal_info'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="solutionAdditonalInfo">Additonal Information</label>
                                            <textarea class="form-control ckeditor" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?> id="solutionAdditonalInfo" placeholder="Additonal Information" name="solutionAdditonalInfo"><?= set_value('solutionAdditonalInfo') ?></textarea>
                                            <?php echo form_error('solutionAdditonalInfo'); ?>
                                        </div>
                                    <?php endif; ?>


                                    <?php if ($controller_config['disable_pr_additonal_info_city'] !== TRUE) : ?>

                                        <div class="form-group col-sm-5">
                                            <label for="cityName">City Name</label>
                                            <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                id="cityName" placeholder="Enter City" name="cityName[]" value="<?= set_value('cityName[]') ?>">
                                            <?php echo form_error('cityName[]'); ?>
                                        </div>

                                        <div class="form-group col-sm-5">
                                            <label for="percentage">Percentage</label>
                                            <input type="number" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                id="percentage" placeholder="Enter Percentage" name="percentage[]" value="<?= set_value('percentage[]') ?>" min="0" max="100">
                                            <?php echo form_error('percentage[]'); ?>
                                        </div>

                                        <!-- Button to add more -->
                                        <div class="form-group col-sm-2  mt-4">
                                            <button type="button" class="btn btn-success" id="addRow">+ Add Another</button>
                                        </div>

                                        <!-- Container for dynamically added rows -->
                                        <div id="dynamicRows"></div>

                                        <script>
                                            document.getElementById('addRow').addEventListener('click', function() {
                                                let container = document.getElementById('dynamicRows');
                                                let newRow = `
            <div class="row mb-2">
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="cityName[]" placeholder="Enter City">
                </div>
                <div class="col-sm-5">
                    <input type="number" class="form-control" name="percentage[]" placeholder="Enter Percentage" min="0" max="100">
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-danger removeRow">X</button>
                </div>
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
                                    <?php endif; ?>
                                    <div class="form-group col-sm-12">
                                        <label for="" class="text-danger"><i>* Image dimension should be 690 x 1280px (Width x Height) and less than 100kb in size are recommended. Image types supported include jpg, jpeg and png. *</i></label>
                                    </div>
                                    <?php if ($controller_config['disable_pr_back_cover_img'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="solutionBackCoverImg">Back Cover Image <a href="javascript:void(0)" class="text-info" data-toggle="tooltip" data-placement="top" title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i class="fa fa-info-circle"></i></a></label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="solutionBackCoverImg" id="solutionBackCoverImg" accept=".png,.jpg,.jpeg">
                                                <label for="solutionBackCoverImg" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <?= form_error('solutionBackCoverImg') ?>
                                            <div id="solutionBackCoverImgError" class="error-text"><?= $solutionBackCoverImgError ?></div>
                                        </div>
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
                                    <?php endif; ?>

                                    <?php if ($controller_config['disable_pr_images'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12" id="solutionFileContainer">
                                            <label for="solutionFile">solution Images</label>
                                            <button type="button" class="btn btn-default" onclick="temp_add_solution()">
                                                <i class="fas fa-plus-circle"></i> Add File
                                            </button>
                                            <input type="hidden" name="solutionFilesCount" id="solutionFilesCount">
                                            <div class="card collapsed-card card-olive mt-3" style="display:none" id="solutionImagesContainer">
                                                <div class="card-header">
                                                    <h3 class="card-title">Uploaded solution Images</h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                            <i class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-12" id="solutionImagesGridView"></div>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label for="" class="text-danger"><i>* Image dimension should be 300 x 300px (Width x Height) and less than 100kb in size are recommended. Image types supported include jpg, jpeg and png. *</i></label>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_pr_note'] !== TRUE) : ?>
                                        <div class="form-group col-sm-12">
                                            <label for="solutionNote">Note</label>
                                            <textarea class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="solutionNote" placeholder="Note" name="solutionNote"><?= set_value('solutionNote') ?></textarea>
                                            <?php echo form_error('solutionNote'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-sm-12 mt-4">
                                        <button type="submit" class="btn btn-success float-right">Save
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
<div class="modal fade" id="solutionFileAddModal" tabindex="-1" role="dialog" aria-labelledby="solutionFileAddModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="solutionFileAddModalTitle">Add solution File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="solutionFileAddModalBody">
                <div class="form-group col-sm-12">
                    <label for="solutionFileTitle">Title</label>
                    <input type="text" class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>" id="solutionFileTitle" placeholder="Title" name="solutionFileTitle" value="">
                </div>
                <div class="form-group col-sm-12">
                    <label for="solutionFileBrowse">solution Image <a href="javascript:void(0)" class="text-info" data-toggle="tooltip" data-placement="top" title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i class="fa fa-info-circle"></i></a></label>
                    <div class="tower-file">
                        <input type="file" class="custom_fileInput" name="solutionFileBrowse" id="solutionFileBrowse" accept=".png,.jpg,.jpeg">
                        <label for="solutionFileBrowse" class="tower-file-button"> <span class="mdi mdi-upload"></span>Browse
                        </label>
                        <button type="button" class="tower-file-clear tower-file-button">
                            Clear
                        </button>
                    </div>
                    <div id="solutionFileAddError" class="error-text"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-redirect="" id="submitsolutionFileBtn" onclick="temp_add_solution_file()">Submit
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tempsolutionFileEditModal" tabindex="-1" role="dialog" aria-labelledby="tempsolutionFileEditModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tempsolutionFileEditModalTitle">Edit File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="tempsolutionFileEditModalBody">
                <input type="hidden" name="temp_solution_file_id" id="temp_solution_file_id">
                <div class="form-group col-sm-12">
                    <label for="tempsolutionFileTitle">Title</label>
                    <input type="text" class="form-control" id="tempsolutionFileTitle" placeholder="Title" name="tempsolutionFileTitle" value="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="temp_submit_solution_file()">Submit
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tempDeletesolutionFileModal" tabindex="-1" role="dialog" aria-labelledby="tempDeletesolutionFileModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tempDeletesolutionFileModalTitle">Confirm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="alertModalBody">
                <input type="hidden" name="tempDeletesolutionFileId" id="tempDeletesolutionFileId">
                <p>Are you sure want to delete this file?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" data-redirect="" id="tempDeletesolutionConfirmBtn" onclick="temp_solution_file_delete_confirm()">Confirm
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
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