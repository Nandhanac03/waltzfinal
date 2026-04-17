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
                        <li class="breadcrumb-item active">Gallery</li>
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
                            <h3 class="card-title">Gallery</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="panel_album_container">
                                        <?php if ($controller_config['disable_album_add'] !== TRUE): ?>
                                            <a href="<?= base_url('panel/album/add') ?>" class="panel_album_link">
                                                <div class="panel_album">
                                                    <div class="panel_album_cover"
                                                         style="background-image: none!important;background-color: #666666;">
                                                        <i class="fa fa-folder-plus"
                                                           style="font-size: 100px;color:#fff;margin: 45px"></i>
                                                        <div class="panel_album_title">Add</div>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php endif; ?>
                                        <?php
                                        if ($albums):
                                            foreach ($albums as $album):
                                                ?>
                                                <a href="<?= base_url('panel/album/edit/' . $album->id) ?>"
                                                   class="panel_album_link">
                                                    <div class="panel_album">
                                                        <div class="panel_album_cover"
                                                        <?php
                                                        $album_cover = './assets/uploads/album/thumb_' . $album->album_cover;
                                                        if (file_exists($album_cover)):
                                                            ?>
                                                                 style="background-image: url('<?= base_url($album_cover) ?>')!important;"
                                                             <?php endif; ?>>
                                                                 <?php if ($controller_config['disable_album_delete'] !== TRUE): ?>
                                                                <div class="panel_album_option_container">
                                                                    <span class="panel_album_option trigger_alert_modal"
                                                                          data-title="Confirm"
                                                                          data-desc="Are you sure want to delete this?"
                                                                          data-redirect="<?= base_url('panel/album/delete/' . $album->id); ?>"><i
                                                                            class="fas fa-trash"></i></span>
                                                                </div>
                                                            <?php endif; ?>
                                                            <div class="panel_album_title"><?= $album->title ?></div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div><!-- /.content-wrapper -->