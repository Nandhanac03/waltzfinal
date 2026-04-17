<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Contacts</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Contacts</li>
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
                            <h4 class="card-title">Contacts</h4>
                            <?php if ($controller_config['disable_contact_add'] != TRUE): ?>
                                <a href="<?= site_url('panel/contact/add') ?>" class="btn btn-sm btn-info float-right"
                                   title="Add"><i class="fas fa-user-plus"></i> Add</a>
                               <?php endif; ?>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped data-table-search-off">
                                <thead>
                                    <tr>
                                        <th>Sl.No.</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <!-- <th>Working Hours</th> -->
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($contacts): $i = 0;
                                        foreach ($contacts as $contact): $i++;
                                            ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= htmlspecialchars($contact->full_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?= htmlspecialchars($contact->address, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?= htmlspecialchars($contact->email, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?= htmlspecialchars($contact->phone, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <!-- <td><?= htmlspecialchars($contact->work_hour, ENT_QUOTES, 'UTF-8'); ?></td> -->
                                                <td>
                                                    <a href="<?= site_url('panel/contact/edit/' . $contact->id . '/' . $contact->language) ?>"
                                                       title='Edit' class="btn-sm btn-primary"><i
                                                            class="fas fa-user-edit"></i></a> 
                                                        <?php if ($controller_config['disable_contact_delete'] != TRUE): ?>
                                                        <a href="#"
                                                           class="btn-sm btn-danger trigger_alert_modal"
                                                           data-title="Confirm"
                                                           data-desc="Are you sure want to delete this?"
                                                           data-redirect="<?= site_url('panel/contact/delete/' . $contact->id . '/' . $contact->language) ?>"
                                                           title='Delete'><i
                                                                class="fas fa-trash-alt"></i></a>
                                                        <?php endif; ?>
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