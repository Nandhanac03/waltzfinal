<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Accounts</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Accounts</li>
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
                            <h4 class="card-title">Accounts</h4>
                            <?php if ($controller_config['disable_add_user'] != TRUE): ?>
                                <a href="<?= site_url('panel/user/add_account') ?>" class="btn btn-sm btn-info float-right"
                                   title="Add"><i class="fas fa-user-plus"></i> Add</a>
                               <?php endif; ?>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped data-table">
                                <thead>
                                    <tr>
                                        <th>Sl.No.</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Groups</th>
                                        <th>Status</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($users):$i = 0;
                                        foreach ($users as $user):
                                            if($user->id==1){
                                                continue;
                                            }
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?= htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?= htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?= htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td>
                                                    <?php
                                                    if ($user->groups) {
                                                        $group_count = 0;
                                                        foreach ($user->groups as $group) {
                                                            $group_count++;
                                                            if ($group_count != 1) {
                                                                echo ', ';
                                                            }
                                                            echo htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8');
                                                        }
                                                    } else {
                                                        echo '--';
                                                    }
                                                    ?>
                                                </td>
                                                <td><?= ($user->active) ? '<label class="bg-success rounded p-1">Active</label>' : '<label class="bg-danger rounded p-1">Inactive</label>'; ?></td>
                                                <td><a href="<?= site_url('panel/user/edit_account/' . $user->id) ?>"
                                                       title='Edit' class="btn-sm btn-primary"><i
                                                            class="fas fa-user-edit"></i></a> 
                                                        <?php if ($controller_config['disable_lm_user_permissions'] != TRUE): ?>
                                                        <a
                                                            href="<?= site_url('panel/user/user_permissions/' . $user->id) ?>"
                                                            title='Permissions' class="btn-sm btn-dark"><i
                                                                class="fas fa-unlock-alt"></i></a>
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