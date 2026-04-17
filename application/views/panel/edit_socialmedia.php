<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Social Media</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/socialmedia/all') ?>">Social Media</a></li>
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
                              action="<?= site_url('panel/socialmedia/edit/' . $socialmedia->id) ?>">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                                               value="<?= set_value('name', $socialmedia->name) ?>">
                                               <?php echo form_error('name'); ?>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="url">Url <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="url" placeholder="Url" name="url"
                                               value="<?= set_value('url', $socialmedia->url) ?>">
                                               <?php echo form_error('url'); ?>
                                    </div>
                                    <div class="form-group  col-md-2 col-sm-12">
                                        <label for="status">Status <span class="text-danger">*</span></label>
                                        <div class="select2-primary">
                                            <select class="form-control select2bs4 select2-primary" name="status"
                                                    id="status" data-dropdown-css-class="select2-primary"
                                                    style="width: 100%;">
                                                <option value="A" <?= $socialmedia->status == 1 ? 'selected' : '' ?>>Active
                                                </option>
                                                <option value="D" <?= $socialmedia->status != 1 ? 'selected' : '' ?>>Inactive
                                                </option>
                                            </select>
                                        </div>
                                        <?php echo form_error('lstatus'); ?>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div><!-- /.content-wrapper -->