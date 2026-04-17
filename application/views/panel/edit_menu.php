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
                              action="<?= site_url('panel/menu/edit/' . $id . '/' . $current_language->id) ?>"
                              enctype="multipart/form-data" id="menuForm">
                            <div class="card-body">
                                <div class="row">
                                    <?php if ($languages && count($languages) > 1 && $controller_config['disable_menu_languages'] != TRUE): ?>
                                        <div class="col-sm-12">										
                                            <ul class="nav nav-tabs mb-4" id="news-content-below-tab" role="tablist">
                                                <?php
                                                $i = 1;
                                                foreach ($languages as $language):
                                                    ?>
                                                    <li class="nav-item">
                                                        <a class="nav-link <?= in_array($language->id, $menu_languages) && $language->id != $current_language->id ? ' bg-navy' : '' ?><?= $language->id == $current_language->id ? ' active bg-success' : '' ?>"
                                                           href="<?= base_url('panel/menu/edit/' . $id . '/' . $language->id) ?>"
                                                           role="tab" aria-selected="true"><?= $language->name ?></a>
                                                    </li>
                                                    <?php
                                                endforeach;
                                                ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($controller_config['disable_menu_parent'] != TRUE): ?>
                                        <div class="form-group col-sm-12 col-md-4 hide" style="display: none;">
                                            <label for="parentMenu">Parent Menu</label>
                                            <select class="custom-select" id="parentMenu" name="parentMenu">
                                                <option value="">None</option>
                                                <?php
                                                if ($menus):
                                                    foreach ($menus as $menu_item):
                                                        if ($menu_item->id == $id) {
                                                            continue;
                                                        }
                                                        ?>
                                                        <option value="<?= $menu_item->id ?>" <?= !empty($menu->parent_id) && $menu_item->id == $menu->parent_id ? 'selected' : '' ?>><?= $menu_item->title ?></option>
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </select>
                                            <?php echo form_error('parentMenu'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group col-sm-12">
                                        <label for="menuTitle">Title <span class="text-danger">*</span></label>
                                        <input type="text"
                                               class="form-control <?= $current_language->direction == 'rtl' ? 'direction-rtl' : '' ?>"
                                               id="menuTitle" placeholder="Title" name="menuTitle"
                                               value="<?= set_value('menuTitle', empty($menu->title) ? '' : $menu->title) ?>" onchange="generate_slug_title(this, 'menuSlugTitle');">
                                               <?php echo form_error('menuTitle'); ?>
                                    </div>
                                    <?php if ($controller_config['disable_menu_slutitle'] != TRUE) : ?>
                                        <div class="form-group col-sm-12" style="display: none;">
                                            <label for="menuSlugTitle">Slug Title</label>
                                            <input type="text" class="form-control" id="menuSlugTitle" placeholder="Slug Title" name="menuSlugTitle" value="<?= set_value('menuTitle', empty($menu->title_slug) ? '' : $menu->title_slug) ?>">
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