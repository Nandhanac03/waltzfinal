<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Advertisement</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/advertisement/all') ?>">Advertisement</a>
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
                              action="<?= site_url('panel/advertisement/edit/' . $id . '/' . $lang) ?>"
                              enctype="multipart/form-data" id="advertisementForm">
                            <div class="card-body">
                                <?php if ($languages && count($languages) > 1 && $controller_config['disable_advertisement_languages'] != TRUE): ?>
                                    <ul class="nav nav-tabs mb-4" id="news-content-below-tab" role="tablist">
                                        <?php
                                        $i = 1;
                                        foreach ($languages as $language):
                                            ?>
                                            <li class="nav-item">
                                                <a class="nav-link <?= in_array($language->id, $advertisement_languages) && $language->id != $lang ? ' bg-navy' : '' ?><?= $language->id == $lang ? ' active bg-success' : '' ?>"
                                                   href="<?= base_url('panel/advertisement/edit/' . $id . '/' . $language->id) ?>"
                                                   role="tab" aria-selected="true"><?= $language->name ?></a>
                                            </li>
                                            <?php
                                        endforeach;
                                        ?>
                                    </ul>
                                <?php endif; ?>
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="advertisementTitle">Title <span class="text-danger">*</span></label>
                                        <input type="text"
                                               class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                               id="advertisementTitle" placeholder="Title" name="advertisementTitle"
                                               value="<?= set_value('advertisementTitle', empty($advertisement->advertisement_title) ? '' : $advertisement->advertisement_title) ?>">
                                               <?php echo form_error('advertisementTitle'); ?>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="advertisementDescription">Description</label>
                                        <textarea class="form-control ckeditor"
                                                  id="advertisementDescription" <?= $current_language->direction == 'rtl' ? 'data-dir="rtl"' : '' ?>
                                                  placeholder="Description"
                                                  name="advertisementDescription"><?= set_value('advertisementDescription', empty($advertisement->description) ? '' : $advertisement->description) ?></textarea>
                                                  <?php echo form_error('advertisementDescription'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_advertisement_link'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="advertisementLink">Link </label>
                                            <input type="text"
                                                   class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                   id="advertisementLink" placeholder="Link" name="advertisementLink"
                                                   value="<?= set_value('advertisementLink', empty($advertisement->link) ? '' : $advertisement->link) ?>">
                                                   <?php echo form_error('advertisementLink'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_advertisement_button_name'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="advertisementButtonName">Button Name </label>
                                            <input type="text"
                                                   class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                                   id="advertisementButtonName" placeholder="Link"
                                                   name="advertisementButtonName"
                                                   value="<?= set_value('advertisementButtonName', empty($advertisement->button_name) ? '' : $advertisement->button_name) ?>">
                                                   <?php echo form_error('advertisementButtonName'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_advertisement_img'] !== TRUE): ?>
                                        <div class="form-group col-sm-12">
                                            <label for="advertisementImg">Advertisement Image <a href="javascript:void(0)"
                                                                                                 class="text-info"
                                                                                                 data-toggle="tooltip"
                                                                                                 data-placement="top"
                                                                                                 title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i
                                                        class="fa fa-info-circle"></i></a></label>
                                            <div class="tower-file">
                                                <input type="file" class="custom_fileInput" name="advertisementImg"
                                                       id="advertisementImg" accept=".png,.jpg,.jpeg">
                                                <label for="advertisementImg" class="tower-file-button"> <span
                                                        class="mdi mdi-upload"></span>Browse </label>
                                                <button type="button" class="tower-file-clear tower-file-button">
                                                    Clear
                                                </button>
                                            </div>
                                            <div id="advertisementImgError"
                                                 class="error-text"><?= $advertisementImgError ?></div>
                                        </div>									
                                        <?php if (!empty($advertisement->advertisement_img)): ?>
                                            <div class="col-sm-12">
                                                <div class="file-img-container">
                                                    <div class="file-img-container-option">
                                                        <a href="javascript:void(0)"
                                                           class="file_edit_btn trigger_alert_modal" data-title="Confirm"
                                                           data-desc="Are you sure want to delete this?"
                                                           data-redirect="<?= base_url('panel/advertisement/delete_advertisement_img/' . $advertisement->id . '/' . $advertisement->language) ?>"><i
                                                                class="fas fa-trash"></i> </a>
                                                    </div>
                                                    <img src="<?= base_url('assets/uploads/web_ad/thumb_' . $advertisement->advertisement_img) ?>"
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