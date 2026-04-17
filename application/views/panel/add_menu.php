<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Menu</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/menu/all') ?>">Menu</a></li>
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
                        <form role="form" method="post" action="<?= site_url('panel/menu/add') ?>"
                              enctype="multipart/form-data" id="menuForm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12 col-md-4">
                                        <label for="parentMenu">Parent Menu</label>
                                        <select class="custom-select" id="parentMenu" name="parentMenu">
                                            <option value="">None</option>
                                            <?php
                                            if ($menus):
                                                foreach ($menus as $menu_item):
                                                    ?>
                                                    <option value="<?= $menu_item->id ?>"><?= $menu_item->title ?></option>
                                                    <?php
                                                endforeach;
                                            endif;
                                            ?>
                                        </select>
                                        <?php echo form_error('parentMenu'); ?>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="menuTitle">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="menuTitle" placeholder="Title"
                                               name="menuTitle" value="<?= set_value('menuTitle') ?>" onchange="generate_slug_title(this, 'menuSlugTitle')">
                                               <?php echo form_error('menuTitle'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_menu_slutitle'] != TRUE) : ?>
                                        <div class="form-group col-sm-12" style="display: none;">
                                            <label for="menuSlugTitle">Slug Title</label>
                                            <input type="text" class="form-control" id="menuSlugTitle" placeholder="Slug Title" name="menuSlugTitle" value="<?= set_value('menuSlugTitle') ?>">
                                            <?php echo form_error('menuSlugTitle'); ?>
                                        </div>
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