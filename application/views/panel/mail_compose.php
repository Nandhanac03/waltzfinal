<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Compose</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/mailer/all') ?>">Article</a></li>
                        <li class="breadcrumb-item active">Compose</li>
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
                            <h3 class="card-title">Compose</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="<?= site_url('panel/mailer/compose') ?>"
                              enctype="multipart/form-data" id="mailerForm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="mailerSubject">Recipients <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="mailerRecipient"
                                               placeholder="Recipents" name="mailerRecipient"
                                               value="<?= set_value('mailerRecipient') ?>">
                                               <?php echo form_error('mailerRecipient'); ?>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="mailerSubject">Subject <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="mailerSubject" placeholder="Subject"
                                               name="mailerSubject" value="<?= set_value('mailerSubject') ?>">
                                               <?php echo form_error('mailerSubject'); ?>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="mailerTitle">Title</label>
                                        <input type="text" class="form-control" id="mailerTitle" placeholder="Subject"
                                               name="mailerTitle" value="<?= set_value('mailerTitle') ?>">
                                               <?php echo form_error('mailerTitle'); ?>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="mailerContent">Content <span class="text-danger">*</span></label>
                                        <textarea class="form-control ckeditor" id="mailerContent" placeholder="Content"
                                                  name="mailerContent"><?= set_value('mailerContent') ?></textarea>
                                                  <?php echo form_error('mailerContent'); ?>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="mailerLink">Link </label>
                                        <input type="text" class="form-control" id="mailerLink" placeholder="Subject"
                                               name="mailerLink" value="<?= set_value('mailerLink') ?>">
                                               <?php echo form_error('mailerLink'); ?>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="mailerLogo">Logo <a href="javascript:void(0)" class="text-info"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="<?= config_item('MAX_IMG_FILE_SIZE_MSG') ?>"><i
                                                    class="fa fa-info-circle"></i></a></label>
                                        <div class="tower-file">
                                            <input type="file" class="custom_fileInput" name="mailerLogo"
                                                   id="mailerLogo" accept=".png,.jpg,.jpeg">
                                            <label for="mailerLogo" class="tower-file-button"> <span
                                                    class="mdi mdi-upload"></span>Browse </label>
                                            <button type="button" class="tower-file-clear tower-file-button">
                                                Clear
                                            </button>
                                        </div>
                                        <div id="mailerLogoErr" class="error-text"><?= $mailerLogoErr ?></div>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-4">
                                        <label for="mailerTemplate">Mail Template<span
                                                class="text-danger">*</span></label>
                                        <select class="custom-select" id="mailerTemplate" name="mailerTemplate">
                                            <?php
                                            if ($mail_templates):
                                                foreach ($mail_templates as $mail_template):
                                                    ?>
                                                    <option value="<?= $mail_template['template'] ?>"><?= $mail_template['template_name'] ?></option>
                                                    <?php
                                                endforeach;
                                            endif;
                                            ?>
                                        </select>
                                        <?php echo form_error('mailerTemplate'); ?>
                                    </div>
                                    <div class="col-sm-12 mt-4">
                                        <button type="button" class="btn btn-primary float-left" id="btnMailPreview"
                                                onclick="mail_preview()">Preview
                                        </button>
                                        <button type="submit" class="btn btn-success float-right">Send</button>
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
<div class="modal fade" id="previewMailModal" tabindex="-1" role="dialog" aria-labelledby="previewMailModal"
     aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewMailModalTitle">Mail Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="previewMailModalBody"></div>
        </div>
    </div>
</div>