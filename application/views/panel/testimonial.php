<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Testimonials</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Testimonials</li>
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
                <div class="col-12">
                    <?= $alert ?>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Testimonials</h4>
                            <a href="<?= site_url('panel/testimonial/add') ?>" class="btn btn-sm btn-info float-right"
                               title="Add"><i class="fas fa-user-plus"></i> Add</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" method="post" action="<?= site_url('panel/testimonial/all') ?>"  style="display: none;">
                                <div class="row mt-2 mb-4">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control dateRangeTimePicker"
                                                   id="filterTestimonialCreatedAt" placeholder="Created At"
                                                   name="filterTestimonialCreatedAt"
                                                   value="<?= set_value('filterTestimonialCreatedAt') ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary float-left">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-bordered table-striped data-table-search-off">
                                <thead>
                                    <tr>
                                        <th>Sl.No.</th>
                                        <th>Statement</th>
                                        <th>Created At</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($testimonials): $i = 0;
                                        foreach ($testimonials as $testimonial): $i++;
                                            ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= htmlspecialchars($testimonial->statement, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?= htmlspecialchars(date('d-m-Y H:i', $testimonial->created_at), ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <a href="<?= site_url('panel/testimonial/edit/' . $testimonial->id . '/' . $testimonial->language) ?>"
                                                       title='Edit' class="btn-sm btn-primary"><i
                                                            class="fas fa-user-edit"></i></a> <a href="#"
                                                                                         class="btn-sm btn-danger trigger_alert_modal"
                                                                                         data-title="Confirm"
                                                                                         data-desc="Are you sure want to delete this?"
                                                                                         data-redirect="<?= site_url('panel/testimonial/delete/' . $testimonial->id . '/' . $testimonial->language) ?>"
                                                                                         title='Delete'><i
                                                            class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div><!-- /.content-wrapper -->