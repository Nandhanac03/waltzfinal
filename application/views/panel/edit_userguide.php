<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Userguide</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/userguide/all') ?>">Userguide</a></li>
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
                    <?php if ($controller_config['disable_userguide_languages'] != TRUE) : ?>
                        <div class="card card-dark card-outline">
                            <div class="card-body">
                                <ul class="nav nav-pills">
                                    <?php if ($languages) : foreach ($languages as $lang_rec) : ?>
                                            <li class="nav-item"><a class="nav-link <?= $lang_rec->id == $lang ? 'active' : '' ?> <?= in_array($lang_rec->id, $userguide_languages) || $lang_rec->id == '1' ? '' : 'disabled' ?>" href="<?= site_url('panel/userguide/edit/' . $id . '/' . $lang_rec->id) ?>"><?= $lang_rec->title ?></a></li>
                                    <?php endforeach;
                                    endif; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Edit Userguide (<?= $current_language->title ?>)</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="<?= site_url('panel/userguide/edit/' . $id . '/' . $lang) ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="title">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="<?= set_value('title', $userguide ? $userguide->title : '') ?>" onchange="generate_slug_title(this, 'slugTitle')">
                                        <?php echo form_error('title'); ?>
                                    </div>
                                    
                                    <div class="form-group col-sm-12" style="display: none;">
                                        <label for="slugTitle">Slug Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="slugTitle" placeholder="Slug Title" name="slugTitle" value="<?= set_value('slugTitle', $userguide ? $userguide->title_slug : '') ?>">
                                        <?php echo form_error('slugTitle'); ?>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label for="subtitle">Subtitle</label>
                                        <input type="text" class="form-control" id="subtitle" placeholder="Subtitle" name="subtitle" value="<?= set_value('subtitle', $userguide ? $userguide->subtitle : '') ?>">
                                        <?php echo form_error('subtitle'); ?>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label for="shortDesc">Short Description</label>
                                        <textarea class="form-control" id="shortDesc" placeholder="Short Description" name="shortDesc"><?= set_value('shortDesc', $userguide ? $userguide->short_desc : '') ?></textarea>
                                        <?php echo form_error('shortDesc'); ?>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label for="description">Description</label>
                                        <textarea class="form-control ckeditor" id="description" placeholder="Description" name="description"><?= set_value('description', $userguide ? $userguide->description : '') ?></textarea>
                                        <?php echo form_error('description'); ?>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label>Status</label>
                                        <select class="form-control" name="status">
                                            <option value="1" <?= set_value('status', $userguide ? $userguide->active : '') == '1' ? 'selected' : '' ?>>Active</option>
                                            <option value="0" <?= set_value('status', $userguide ? $userguide->active : '') == '0' ? 'selected' : '' ?>>Inactive</option>
                                        </select>
                                    </div>

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
