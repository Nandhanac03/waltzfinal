$(document).ready(function () {
    //auto dismiss using css class
    setTimeout(function () {
        $('.auto-dismiss').fadeOut();
    }, 5000);
    // allow numeric
    $(".allow_numeric").on("input", function (evt) {
        var self = $(this);
        self.val(self.val().replace(/[^\d].+/, ""));
        if ((evt.which < 48 || evt.which > 57)) {
            evt.preventDefault();
        }
    });
    // allow decimal
    $(".allow_decimal").on("input", function (evt) {
        var self = $(this);
        self.val(self.val().replace(/[^0-9\.]/g, ''));
        if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) {
            evt.preventDefault();
        }
    });
    //setting data table
    $('.data-table').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
    });
    //setting data table with out search
    $('.data-table-search-off').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": true,
    });
    //Initializing Select2 dropdown
    $('.select2').select2();
    //Initializing Select2 dropdown style like boostrap
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });
    //calling alert modal on click
    $('.trigger_alert_modal').click(function (e) {
        e.preventDefault();
        //getting alert modal values from clicked element data attribute
        var title = $(this).data('title');
        var description = $(this).data('desc');
        var redirect_url = $(this).data('redirect');
        if (title && description) {
            $('#alertModalTitle').html(title);
            $('#alertModalBody').html('<p>' + description + '</p>');
            $('#alertModalConfirmBtn').attr('redirect', redirect_url);
            $('#alertModal').modal('show');
        }
    });
    //alert modal confirm btn
    $('#alertModalConfirmBtn').click(function () {
        var redirect_url = $(this).attr('redirect');
        if (redirect_url) {
            window.location.href = redirect_url;
        }
    });
    //Initializing boostrap switch
    $("input[data-bootstrap-switch]").each(function () {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
    //Initializing Boostrap Custom File Input
    bsCustomFileInput.init();
    //Initializing Custom File Input
    $('.custom_fileInput').fileInput({
        iconClass: 'mdi mdi-fw mdi-upload',
        imgPreviewClass: 'custom_fileInput_priview',
        fileList: true,
        imgPreview: true
    });
    //date picker
    $('.datePicker').daterangepicker({
        showDropdowns: true,
        autoUpdateInput: false,
        singleDatePicker: true,
        autoUpdateInput: false,
        locale: {
            format: 'DD/MM/YYYY',
            "applyLabel": "Ok",
            "cancelLabel": "Clear",
            "daysOfWeek": [
                "Su",
                "Mo",
                "Tu",
                "We",
                "Th",
                "Fr",
                "Sa"
            ],
            "monthNames": [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December"
            ],
            "firstDay": 1
        }
    });
    $('.datePicker').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY'));
    });
    $('.datePicker').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });
    //date and time picker
    $('.dateTimePicker').daterangepicker({
        showDropdowns: true,
        singleDatePicker: true,
        timePicker: true,
        autoUpdateInput: false,
        timePickerIncrement: 5,
        timePicker24Hour: true,
        locale: {
            format: 'DD/MM/YYYY HH:mm',
            "applyLabel": "Ok",
            "cancelLabel": "Clear",
            "daysOfWeek": [
                "Su",
                "Mo",
                "Tu",
                "We",
                "Th",
                "Fr",
                "Sa"
            ],
            "monthNames": [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December"
            ],
            "firstDay": 1
        }
    });
    $('.dateTimePicker').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY HH:mm'));
    });
    $('.dateTimePicker').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });
    //date, time and range  picker
    $('.dateRangeTimePicker').daterangepicker({
        showDropdowns: true,
        singleDatePicker: false,
        timePicker: true,
        autoUpdateInput: false,
        timePickerIncrement: 5,
        timePicker24Hour: true,
        locale: {
            format: 'DD/MM/YYYY HH:mm',
            "applyLabel": "Ok",
            "cancelLabel": "Clear",
            "daysOfWeek": [
                "Su",
                "Mo",
                "Tu",
                "We",
                "Th",
                "Fr",
                "Sa"
            ],
            "monthNames": [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December"
            ],
            "firstDay": 1
        }
    });
    $('.dateRangeTimePicker').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY HH:mm') + ' - ' + picker.endDate.format('DD/MM/YYYY HH:mm'));
    });
    $('.dateRangeTimePicker').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });
    //Initializing boostrap tooltip
    $('[data-toggle="tooltip"]').tooltip()
    //select2 product search ajax
    $(".select2_product_search").select2({
        ajax: {
            type: 'post',
            url: BASE_URL + 'panel/product/ajax_get_products_list',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    search_product: params.term
                };
            },
            processResults: function (data, params) {
                var data = $.map(data, function (obj) {
                    obj.id = obj.id;
                    obj.text = obj.text;
                    return obj;
                });
                return {
                    results: data,
                };
            },
            cache: true
        },
        placeholder: 'Search product',
        minimumInputLength: 3,
    });
    //select2 customer search ajax
    $(".select2_customer_search").select2({
        ajax: {
            type: 'post',
            url: BASE_URL + 'panel/user/ajax_get_customer',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    search_customer: params.term
                };
            },
            processResults: function (data, params) {
                var data = $.map(data, function (obj) {
                    obj.id = obj.id;
                    obj.text = obj.text;
                    return obj;
                });
                return {
                    results: data,
                };
            },
            cache: true
        },
        placeholder: 'Search customer',
        minimumInputLength: 3,
    });
});
//setting Ckeditor configuration from data attribute of the elements
CKEDITOR.on('instanceCreated', function (evt) {
    var editor = evt.editor,
        element = editor.element,
        lang = element.data('lang');
    if (lang)
        evt.editor.config.language = lang;
    var dir = element.data('dir');
    if (dir)
        evt.editor.config.contentsLangDirection = dir;
});

//changing what to show according to selection of news type in add news and edit news
function newsTypeChanged(e) {
    $('#newsMultimediaFile').val('');
    $('#newsPressVideoLink').val('');
    $('#newsVideoFile').val('');
    $('#newsMultimediaFileContainer').hide();
    $('#newsPressVideoFileContainer').hide();
    if (e.value == 'M') {
        $('#newsMultimediaFileContainer').show();
    } else if (e.value == 'PV') {
        $('#newsPressVideoFileContainer').show();
    }
}

//function to slugify the text
function slugify(text) {
    return text.toString().toLowerCase()
        .replace(/\s+/g, '-')           //Replace spaces with -
        .replace(/[^\w\-]+/g, '')       //Remove all non-word chars
        .replace(/\-\-+/g, '-')         //Replace multiple - with single -
        .replace(/^-+/, '')             //Trim - from start of text
        .replace(/-+$/, '');            //Trim - from end of text
}

//function to set slugified text in news add and edit page
function generate_slug_title(e, to_id) {
    $('#' + to_id).val('');
    var title = e.value.trim();
    var slug_title = slugify(title);
    $('#' + to_id).val(slug_title);
}

//function to submit the news form
function news_form_submit() {
    // $('#newsStatus').val(v);
    $('#newsForm').submit();
}

//function to show the multimedia file add modal
function multimedia_update_modal_show() {
    $('#multimediaFileUpdateBrowse').val('').trigger('change');
    $('#multimediaFileUpdateTitle').val('');
    $('#multimediaFileUpdateError').html('');
    $('#multimediaFileUpdateModal').modal('show');
}

//ajax form submit to submit the multimedia file
$('#multimediaFileUpdateModalForm').ajaxForm({
    success: function (data) {
        if (data == true) {
            get_multimedia_files();
            $('#multimediaFileUpdateBrowse').val('').trigger('change');
            $('#multimediaFileUpdateTitle').val('');
            $('#multimediaFileUpdateError').html('');
            $('#multimediaFileUpdateModal').modal('hide');
        } else {
            $('#multimediaFileUpdateError').html(data);
        }
    }
});

//function to get all the multimedia files
function get_multimedia_files() {
    var newsroom_id = $('#newsroom_id').val();
    var language_id = $('#language_id').val();
    $.ajax({
        url: BASE_URL + 'panel/news/ajax_get_multimedia_files',
        type: 'POST',
        data: {
            newsroom_id: newsroom_id,
            language_id: language_id
        },
        success: function (data) {
            if (data.trim().length > 0) {
                $('#multimediaImagesContainer').show();
                $('#multimediaImagesGridView').html(data);
            } else {
                $('#multimediaImagesGridView').html('');
                $('#multimediaImagesContainer').hide();
            }
        }
    })
}

//function to edit the multimedia file description
function multimedia_file_edit(e, file_id) {
    $('#multimediaFileTitle').val('');
    $('#multimediaFileEditError').html('');
    var title = $(e).data('file-title');
    if (title) {
        $('#multimediaFileTitle').val(title);
    }
    $('#multimedia_file_id').val(file_id);
    $('#multimediaFileEditModal').modal('show');
}

//function to edit multimedia file description
$('#multimediaFileEditModalForm').ajaxForm({
    success: function (data) {
        if (data == true) {
            $('#multimedia_file_id').val('');
            $('#multimediaFileTitle').val('');
            $('#multimediaFileEditModal').modal('hide');
            get_multimedia_files();
        } else {
            $('#multimediaFileEditError').html(data);
        }
    }
});

//function to show modal to confirm delete file
function multimedia_file_delete(file_id) {
    if (file_id > 0) {
        $('#deleteMultimediaFileId').val(file_id);
        $('#deleteMultimediaFileModal').modal('show');
    }
}

//ajax from confirm submit to delete the multimedia file
$('#deleteMultimediaFileModalForm').ajaxForm({
    success: function (data) {
        if (data == true) {
            $('#deleteMultimediaFileId').val('');
            $('#deleteMultimediaFileModal').modal('hide');
            get_multimedia_files();
        }
    }
});

//function to show modal and add featured images
function featured_update_modal_show() {
    $('#featuredFileUpdateBrowse').val('').trigger('change');
    $('#featuredFileUpdateTitle').val('');
    $('#featuredFileUpdateDesc').val('');
    $('#featuredFileUpdateError').html('');
    $('#featuredFileUpdateModal').modal('show');
}

//ajax form submit to upload the featured image
$('#featuredFileUpdateModalForm').ajaxForm({
    success: function (data) {
        if (data == true) {
            get_featured_files();
            $('#featuredFileUpdateBrowse').val('').trigger('change');
            $('#featuredFileUpdateTitle').val('');
            $('#featuredFileUpdateDesc').val('');
            $('#featuredFileUpdateError').html('');
            $('#featuredFileUpdateModal').modal('hide');
        } else {
            $('#featuredFileUpdateError').html(data);
        }
    }
});

//function to load all the featured images
function get_featured_files() {
    var newsroom_id = $('#newsroom_id').val();
    var language_id = $('#language_id').val();
    $.ajax({
        url: BASE_URL + 'panel/news/ajax_get_featured_files',
        type: 'POST',
        data: {
            newsroom_id: newsroom_id,
            language_id: language_id
        },
        success: function (data) {
            if (data.trim().length > 0) {
                $('#featuredImagesContainer').show();
                $('#featuredImagesGridView').html(data);
            } else {
                $('#featuredImagesGridView').html('');
                $('#featuredImagesContainer').hide();
            }
        }
    })
}

//function to edit the featured image description
function featured_file_edit(e, file_id) {
    $('#featuredFileTitle').val('');
    $('#featuredFileDesc').val('');
    $('#featuredFileEditError').html('');
    var title = $(e).data('file-title');
    if (title) {
        $('#featuredFileTitle').val(title);
    }
    var description = $(e).data('file-description');
    if (description) {
        $('#featuredFileDesc').val(description);
    }
    $('#featured_file_id').val(file_id);
    $('#featuredFileEditModal').modal('show');
}

//ajax form submit to update the featured image description
$('#featuredFileEditModalForm').ajaxForm({
    success: function (data) {
        if (data == true) {
            $('#featured_file_id').val('');
            $('#featuredFileTitle').val('');
            $('#featuredFileDesc').val('');
            $('#featuredFileEditModal').modal('hide');
            get_featured_files();
        } else {
            $('#featuredFileEditError').html(data);
        }
    }
});

//function to call the confirm modal before deleting the featured image
function featured_file_delete(file_id) {
    if (file_id > 0) {
        $('#deleteFeaturedFileId').val(file_id);
        $('#deleteFeaturedFileModal').modal('show');
    }
}

//ajax form submit confirmed delete the featured image
$('#deleteFeaturedFileModalForm').ajaxForm({
    success: function (data) {
        if (data == true) {
            $('#deleteFeaturedFileId').val('');
            $('#deleteFeaturedFileModal').modal('hide');
            get_featured_files();
        }
    }
});

//function to show the modal to add multimedia file
function temp_add_multimedia() {
    $('#multimediaFileBrowse').val('').trigger('change');
    $('#multimediaFileTitle').val('');
    $('#multimediaFileAddError').html('');
    $('#multimediaFileAddModal').modal('show');
}

//function to temporarily add multimedia file in hidden file input and description in hidden input and preview the file
function temp_add_multimedia_file() {
    $('#multimediaFileAddError').html('');
    $('#multimediaFileAddError').hide();
    var fileLength = $('#multimediaFileBrowse')[0].files.length;
    if (fileLength > 0) {
        var multimediaFileTitle = $('#multimediaFileTitle').val();
        var hiddenFileLength = +$('.hiddenMultimediaFile').length + 1;
        $('#newsMultimediaFilesCount').val(hiddenFileLength);
        $('#newsMultimediaFileContainer').append('<input type="file" id="multimediaFile_' + hiddenFileLength + '" name="multimediaFile_' + hiddenFileLength + '" class="hiddenMultimediaFile" style="display: none;">');
        $('#newsMultimediaFileContainer').append('<input type="hidden" id="multimediaFileTitle_' + hiddenFileLength + '" name="multimediaFileTitle_' + hiddenFileLength + '" class="hiddenMultimediaFileTitle" value="' + multimediaFileTitle + '">');
        $('#multimediaFile_' + hiddenFileLength).prop('files', $('#multimediaFileBrowse')[0].files);
        if ($('#multimediaFile_' + hiddenFileLength)[0].files.length > 0) {
            var reader = new FileReader();
            reader.onload = function (el) {
                var append_img = '<div class="file-img-container" id="multimediaFile_' + hiddenFileLength + '_img_container">' +
                    '<div class="file-img-container-option">' +
                    '<a href="javascript:void(0)" ' +
                    'class="file_edit_btn" title="Delete" ' +
                    'onclick="temp_multimedia_file_delete(' + hiddenFileLength + ')">' +
                    '<i	class="fas fa-trash"></i> </a>' +
                    '<a href="javascript:void(0)" class="file_edit_btn" title="Edit" ' +
                    ' onclick="temp_edit_multimedia_file_btn(' + hiddenFileLength + ')"><i	class="fas fa-edit"></i> </a></div>' +
                    '<img src="' + el.target.result + '" class="img-fluid" id="multimediaFile_' + hiddenFileLength + '_img"/>';
                if (multimediaFileTitle.length > 0) {
                    append_img += '<div class="file-img-title" id="multimediaFile_' + hiddenFileLength + '_img_title"><span title="">' + multimediaFileTitle + '</span></div>';
                } else {
                    append_img += '<div class="file-img-title" id="multimediaFile_' + hiddenFileLength + '_img_title"><span title="">--</span></div>';
                }
                append_img += '</div>';
                $('#multimediaImagesGridView').append(append_img);
                $('#multimediaImagesContainer').show();
            }
            reader.readAsDataURL($('#multimediaFile_' + hiddenFileLength)[0].files[0]);
        }
        $('#multimediaFileBrowse').val('').trigger('change');
        $('#multimediaFileTitle').val('');
        $('#multimediaFileAddModal').modal('hide');
    } else {
        $('#multimediaFileAddError').html('File required.');
        $('#multimediaFileAddError').show();
    }
}

//function to edit temporarily added multimedia file description
function temp_edit_multimedia_file_btn(temp_id) {
    $('#temp_multimedia_file_id').val(temp_id);
    var title = $("#multimediaFileTitle_" + temp_id).val();
    $('#tempMultimediaFileTitle').val(title);
    $('#tempMultimediaFileEditModal').modal('show');
}

//function to temporarily edit the multimedia file description
function temp_submit_multimedia_file() {
    var temp_id = $('#temp_multimedia_file_id').val();
    var title = $("#tempMultimediaFileTitle").val();
    $("#multimediaFileTitle_" + temp_id).val(title);
    $("#multimediaFile_" + temp_id + "_img_title span").html(title);
    $("#multimediaFile_" + temp_id + "_img_title span").attr('title', title);
    $('#tempMultimediaFileEditModal').modal('hide');
}

//function to show confirm modal to  delete temporarily added multimedia file
function temp_multimedia_file_delete(file_id) {
    if (file_id > 0) {
        $('#tempDeleteMultimediaFileId').val(file_id);
        $('#tempDeleteMultimediaFileModal').modal('show');
    }
}

//function to delete temporarily added multimedia file
function temp_multimedia_file_delete_confirm() {
    var temp_id = $('#tempDeleteMultimediaFileId').val();
    if (temp_id > 0) {
        $("#multimediaFile_" + temp_id).val('');
        $("#multimediaFileTitle_" + temp_id).val('');
        $("#multimediaFile_" + temp_id + "_img_container").html('');
        $("#multimediaFile_" + temp_id + "_img_container").hide();
        $('#tempDeleteMultimediaFileId').val('');
        $('#tempDeleteMultimediaFileModal').modal('hide');
    }
}

//function show modal to add temporary featured image
function temp_add_featured() {
    $('#featuredFileBrowse').val('').trigger('change');
    $('#featuredFileTitle').val('');
    $('#featuredFileDesc').val('');
    $('#featuredFileAddError').html('');
    $('#featuredFileAddModal').modal('show');
}

//function add temporary featured image
function temp_add_featured_file() {
    $('#featuredFileAddError').html('');
    $('#featuredFileAddError').hide();
    var fileLength = $('#featuredFileBrowse')[0].files.length;
    if (fileLength > 0) {
        var featuredFileTitle = $('#featuredFileTitle').val();
        var featuredFileDesc = $('#featuredFileDesc').val();
        var hiddenFileLength = +$('.hiddenFeaturedFile').length + 1;
        $('#newsFeaturedFilesCount').val(hiddenFileLength);
        $('#newsFeaturedFileContainer').append('<input type="file" id="featuredFile_' + hiddenFileLength + '" name="featuredFile_' + hiddenFileLength + '" class="hiddenFeaturedFile" style="display: none;">');
        $('#newsFeaturedFileContainer').append('<input type="hidden" id="featuredFileTitle_' + hiddenFileLength + '" name="featuredFileTitle_' + hiddenFileLength + '" class="hiddenFeaturedFileTitle" value="' + featuredFileTitle + '">');
        $('#newsFeaturedFileContainer').append('<input type="hidden" id="featuredFileDesc_' + hiddenFileLength + '" name="featuredFileDesc_' + hiddenFileLength + '" class="hiddenFeaturedFileDesc" value="' + featuredFileDesc + '">');
        $('#featuredFile_' + hiddenFileLength).prop('files', $('#featuredFileBrowse')[0].files);
        if ($('#featuredFile_' + hiddenFileLength)[0].files.length > 0) {
            var reader = new FileReader();
            reader.onload = function (el) {
                var append_img = '<div class="file-img-container" id="featuredFile_' + hiddenFileLength + '_img_container">' +
                    '<div class="file-img-container-option">' +
                    '<a href="javascript:void(0)" ' +
                    'class="file_edit_btn" title="Delete" ' +
                    'onclick="temp_featured_file_delete(' + hiddenFileLength + ')">' +
                    '<i	class="fas fa-trash"></i> </a>' +
                    '<a href="javascript:void(0)" class="file_edit_btn" title="Edit" ' +
                    ' onclick="temp_edit_featured_file_btn(' + hiddenFileLength + ')"><i	class="fas fa-edit"></i> </a></div>' +
                    '<img src="' + el.target.result + '" class="img-fluid" id="featuredFile_' + hiddenFileLength + '_img"/>';
                if (featuredFileTitle.length > 0) {
                    append_img += '<div class="file-img-title" id="featuredFile_' + hiddenFileLength + '_img_title"><span title="">' + featuredFileTitle + '</span></div>';
                } else {
                    append_img += '<div class="file-img-title" id="featuredFile_' + hiddenFileLength + '_img_title"><span title="">--</span></div>';
                }
                append_img += '</div>';
                $('#featuredImagesGridView').append(append_img);
                $('#featuredImagesContainer').show();
            }
            reader.readAsDataURL($('#featuredFile_' + hiddenFileLength)[0].files[0]);
        }
        $('#featuredFileBrowse').val('').trigger('change');
        $('#featuredFileTitle').val('');
        $('#featuredFileDesc').val('');
        $('#featuredFileAddModal').modal('hide');
    } else {
        $('#featuredFileAddError').html('File required.');
        $('#featuredFileAddError').show();
    }
}

//function to edit temporarily added featured image description
function temp_edit_featured_file_btn(temp_id) {
    $('#temp_featured_file_id').val(temp_id);
    var title = $("#featuredFileTitle_" + temp_id).val();
    $('#tempFeaturedFileTitle').val(title);
    var desc = $("#featuredFileDesc_" + temp_id).val();
    $('#tempFeaturedFileDesc').val(desc);
    $('#tempFeaturedFileEditModal').modal('show');
}

//function to submit temporarily added featured image description
function temp_submit_featured_file() {
    var temp_id = $('#temp_featured_file_id').val();
    var title = $("#tempFeaturedFileTitle").val();
    $("#featuredFileTitle_" + temp_id).val(title);
    var desc = $("#tempFeaturedFileDesc").val();
    $("#featuredFileDesc_" + temp_id).val(desc);
    $("#featuredFile_" + temp_id + "_img_title span").html(title);
    $("#featuredFile_" + temp_id + "_img_title span").attr('title', title);
    $('#tempFeaturedFileEditModal').modal('hide');
}

//function show confirm modal to temporarily added featured image
function temp_featured_file_delete(file_id) {
    if (file_id > 0) {
        $('#tempDeleteFeaturedFileId').val(file_id);
        $('#tempDeleteFeaturedFileModal').modal('show');
    }
}

//function delete the temporarily added featured image
function temp_featured_file_delete_confirm() {
    var temp_id = $('#tempDeleteFeaturedFileId').val();
    if (temp_id > 0) {
        $("#featuredFile_" + temp_id).val('');
        $("#featuredFileTitle_" + temp_id).val('');
        $("#featuredFile_" + temp_id + "_img_container").html('');
        $("#featuredFile_" + temp_id + "_img_container").hide();
        $('#tempDeleteFeaturedFileId').val('');
        $('#tempDeleteFeaturedFileModal').modal('hide');
    }
}

//function for mail preview
function mail_preview() {
    $('#previewMailModalBody').html('');
    var mail_template = $('#mailerTemplate').val();
    var mail_title = $('#mailerTitle').val();
    var mail_link = $('#mailerLink').val();
    var mail_subject = $('#mailerSubject').val();
    var mail_content = CKEDITOR.instances['mailerContent'].getData();
    var mail_logo = $('#mailerLogo')[0].files[0];
    var fd = new FormData();
    fd.append('mail_logo', mail_logo);
    fd.append('mail_subject', mail_subject);
    fd.append('mail_template', mail_template);
    fd.append('mail_title', mail_title);
    fd.append('mail_link', mail_link);
    fd.append('mail_content', mail_content);
    $.ajax({
        url: BASE_URL + 'panel/mailer/preview?iframe=Y',
        type: 'POST',
        data: fd,
        contentType: false,
        processData: false,
        success: function (data) {
            $('#previewMailModalBody').html(data);
            $('#previewMailModal').modal('show');
        }
    });
}

//function to show the product file add modal
function product_update_modal_show() {
    $('#productFileUpdateBrowse').val('').trigger('change');
    $('#productFileUpdateTitle').val('');
    $('#productFileUpdateError').html('');
    $('#productFileUpdateModal').modal('show');
}

//ajax form submit to submit the product file
$('#productFileUpdateModalForm').ajaxForm({
    success: function (data) {
        if (data == true) {
            get_product_files();
            $('#productFileUpdateBrowse').val('').trigger('change');
            $('#productFileUpdateTitle').val('');
            $('#productFileUpdateError').html('');
            $('#productFileUpdateModal').modal('hide');
        } else {
            $('#productFileUpdateError').html(data);
        }
    }
});

//function to get all the product files
function get_product_files() {
    var product_id = $('#hid_product_id').val();
    var language_id = $('#hid_lang_id').val();
    $.ajax({
        url: BASE_URL + 'panel/product/ajax_get_product_files',
        type: 'POST',
        data: {
            product_id: product_id,
            language_id: language_id
        },
        success: function (data) {
            if (data.trim().length > 0) {
                $('#productImagesContainer').show();
                $('#productImagesGridView').html(data);
            } else {
                $('#productImagesGridView').html('');
                $('#productImagesContainer').hide();
            }
        }
    })
}

//function to edit the product file description
function product_file_edit(e, file_id) {
    $('#productFileTitle').val('');
    $('#productFileEditError').html('');
    var title = $(e).data('file-title');
    if (title) {
        $('#productFileTitle').val(title);
    }
    $('#product_file_id').val(file_id);
    $('#productFileEditModal').modal('show');
}

//function to edit product file description
$('#productFileEditModalForm').ajaxForm({
    success: function (data) {
        if (data == true) {
            $('#product_file_id').val('');
            $('#productFileTitle').val('');
            $('#productFileEditModal').modal('hide');
            get_product_files();
        } else {
            $('#productFileEditError').html(data);
        }
    }
});

//function to show modal to confirm delete file
function product_file_delete(file_id) {
    if (file_id > 0) {
        $('#deleteProductFileId').val(file_id);
        $('#deleteProductFileModal').modal('show');
    }
}

//ajax from confirm submit to delete the product file
$('#deleteProductFileModalForm').ajaxForm({
    success: function (data) {
        if (data == true) {
            $('#deleteProductFileId').val('');
            $('#deleteProductFileModal').modal('hide');
            get_product_files();
        }
    }
});

//function to show the modal to add product file
function temp_add_product() {
    $('#productFileBrowse').val('').trigger('change');
    $('#productFileTitle').val('');
    $('#productFileAddError').html('');
    $('#productFileAddModal').modal('show');
}

//function to temporarily add product file in hidden file input and description in hidden input and preview the file
function temp_add_product_file() {
    $('#productFileAddError').html('');
    $('#productFileAddError').hide();
    var fileLength = $('#productFileBrowse')[0].files.length;
    if (fileLength > 0) {
        var productFileTitle = $('#productFileTitle').val();
        var hiddenFileLength = +($('.hiddenProductFile').length) + 1;
        $('#productFilesCount').val(hiddenFileLength);
        $('#productFileContainer').append('<input type="file" id="productFile_' + hiddenFileLength + '" name="productFile_' + hiddenFileLength + '" class="hiddenProductFile" style="display: none;">');
        $('#productFileContainer').append('<input type="hidden" id="productFileTitle_' + hiddenFileLength + '" name="productFileTitle_' + hiddenFileLength + '" class="hiddenProductFileTitle" value="' + productFileTitle + '">');
        $('#productFile_' + hiddenFileLength).prop('files', $('#productFileBrowse')[0].files);
        $('#productFile_' + hiddenFileLength).trigger('change');
        if ($('#productFile_' + hiddenFileLength)[0].files.length > 0) {
            var reader = new FileReader();
            reader.onload = function (el) {
                var append_img = '<div class="file-img-container" id="productFile_' + hiddenFileLength + '_img_container">' +
                    '<div class="file-img-container-option">' +
                    '<a href="javascript:void(0)" ' +
                    'class="file_edit_btn" title="Delete" ' +
                    'onclick="temp_product_file_delete(' + hiddenFileLength + ')">' +
                    '<i	class="fas fa-trash"></i> </a>' +
                    '<a href="javascript:void(0)" class="file_edit_btn" title="Edit" ' +
                    ' onclick="temp_edit_product_file_btn(' + hiddenFileLength + ')"><i	class="fas fa-edit"></i> </a></div>' +
                    '<img src="' + el.target.result + '" class="img-fluid" id="productFile_' + hiddenFileLength + '_img"/>';
                if (productFileTitle.length > 0) {
                    append_img += '<div class="file-img-title" id="productFile_' + hiddenFileLength + '_img_title"><span title="">' + productFileTitle + '</span></div>';
                } else {
                    append_img += '<div class="file-img-title" id="productFile_' + hiddenFileLength + '_img_title"><span title="">--</span></div>';
                }
                append_img += '</div>';
                $('#productImagesGridView').append(append_img);
                $('#productImagesContainer').show();
            }
            reader.readAsDataURL($('#productFile_' + hiddenFileLength)[0].files[0]);
        }
        $('#productFileBrowse').val('').trigger('change');
        $('#productFileTitle').val('');
        $('#productFileAddModal').modal('hide');
    } else {
        $('#productFileAddError').html('File required.');
        $('#productFileAddError').show();
    }
}

//function to edit temporarily added product file description
function temp_edit_product_file_btn(temp_id) {
    $('#temp_product_file_id').val(temp_id);
    var title = $("#productFileTitle_" + temp_id).val();
    $('#tempProductFileTitle').val(title);
    $('#tempProductFileEditModal').modal('show');
}

//function to temporarily edit the product file description
function temp_submit_product_file() {
    var temp_id = $('#temp_product_file_id').val();
    var title = $("#tempProductFileTitle").val();
    $("#productFileTitle_" + temp_id).val(title);
    $("#productFile_" + temp_id + "_img_title span").html(title);
    $("#productFile_" + temp_id + "_img_title span").attr('title', title);
    $('#tempProductFileEditModal').modal('hide');
}

//function to show confirm modal to  delete temporarily added product file
function temp_product_file_delete(file_id) {
    if (file_id > 0) {
        $('#tempDeleteProductFileId').val(file_id);
        $('#tempDeleteProductFileModal').modal('show');
    }
}

//function to delete temporarily added product file
function temp_product_file_delete_confirm() {
    var temp_id = $('#tempDeleteProductFileId').val();
    if (temp_id > 0) {
        $("#productFile_" + temp_id).val('');
        $("#productFileTitle_" + temp_id).val('');
        $("#productFile_" + temp_id + "_img_container").html('');
        $("#productFile_" + temp_id + "_img_container").hide();
        $('#tempDeleteProductFileId').val('');
        $('#tempDeleteProductFileModal').modal('hide');
    }
}

function customer_checkout(customer_id) {
    window.location.href = BASE_URL + 'panel/product/checkout/' + customer_id;
}

//function to get cart products
function ajax_get_cart_products() {

    var user_id = $('#user_id').val();
    $.ajax({
        url: BASE_URL + 'panel/product/ajax_get_cart_products',
        type: 'POST',
        data: {
            user_id: user_id
        },
        success: function (data) {
            if (data.trim().length > 0) {
                $('#cart_items').html(data);
            }
        }
    });
}

//function to add product to cart
function add_cart_product() {
    var product_id = $('#cartProduct').val();
    var user_id = $('#user_id').val();
    $.ajax({
        url: BASE_URL + 'panel/product/ajax_add_cart',
        type: 'POST',
        data: {
            product_id: product_id,
            user_id: user_id
        },
        success: function (data) {
            if (data.trim() == true) {
                ajax_get_cart_products();
                $('#product_cart_alert_msg').html('<p class="text-success text-center">Product added to cart succesfully.</p>')
            } else {
                $('#product_cart_alert_msg').html('<p class="text-danger text-center">' + data + '</p>');
            }
        }
    });
}

//function to update cart required stock
function update_required_stock(product_id, unit_stock_required) {
    var user_id = $('#user_id').val();
    $.ajax({
        url: BASE_URL + 'panel/product/ajax_update_cart_product',
        type: 'POST',
        data: {
            user_id: user_id,
            product_id: product_id,
            unit_stock_required: unit_stock_required
        },
        success: function (data) {
            if (data.trim() == true) {
                ajax_get_cart_products();
                $('#product_cart_alert_msg').html('<p class="text-success text-center">Cart updated succesfully.</p>')
            } else {
                $('#product_cart_alert_msg').html('<p class="text-danger text-center">' + data + '</p>');
            }
        }
    });
}

//function to remove cart product
function ajax_remove_cart_product(product_id) {
    var user_id = $('#user_id').val();
    $.ajax({
        url: BASE_URL + 'panel/product/ajax_remove_cart_product',
        type: 'POST',
        data: {
            user_id: user_id,
            product_id: product_id
        },
        success: function (data) {
            if (data.trim() == true) {
                ajax_get_cart_products();
                $('#product_cart_alert_msg').html('<p class="text-success text-center">Cart product remove successfully.</p>')
            } else {
                $('#product_cart_alert_msg').html('<p class="text-danger text-center">' + data + '</p>');
            }
        }
    });
}

//function to ship different address
function ship_address_different(e) {
    if (e.checked == true) {
        $('#ship_diff_address').show();
    } else {
        $('#ship_diff_address').hide();
    }
}
// function calculate discount price
function find_discount(orginal_price, discount_price, target) {
    if (orginal_price > discount_price && discount_price > 0 && orginal_price > 0) {
        let percent = ((orginal_price - discount_price) * 100) / orginal_price;
        $('#' + target).val(percent.toFixed(2));
    } else {
        $('#' + target).val('');
    }
}
// function calculate discount by percentage
function find_discount_by_percentage(orginal_price, discount_percentage, target) {
    if (discount_percentage > 0 && discount_percentage <= 100 && orginal_price > 0) {
        let discount_amount = orginal_price - (orginal_price * (discount_percentage / 100));
        $('#' + target).val(discount_amount.toFixed(2));
    } else {
        $('#' + target).val('');
    }
}

function str_to_underscore(el, target) {
    var str = $(el).val();
    str=str.replace(/[^a-zA-Z0-9]/g,'_');
    str=str.toUpperCase();
    $('#' + target).val(str);
}