<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">User Permissions</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/accounts') ?>">Accounts</a></li>
                        <li class="breadcrumb-item active">User Permissions</li>
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
                    <form role="form" method="post" action="<?= site_url('panel/user/user_permissions/' . $user->id) ?>">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Permissions for user - <?= $user->username ?></h4>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped data-table">
                                    <thead>
                                        <tr>
                                            <th>Sl.No.</th>
                                            <th>Permission</th>
                                            <th>Allow</th>
                                            <th>Deny</th>
                                            <th>Inherit From Group</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($permissions) : $i = 0;
                                            foreach ($permissions as $k => $v) :
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td><?= $i ?></td>
                                                    <td><?php echo $v['name']; ?></td>
                                                    <td>
                                                        <div class="icheck-success d-inline">
                                                            <input type="radio" name="uPermission_<?= $v['id'] ?>"
                                                                   id="uPermission_<?= $v['id'] ?>_r1" <?= $this->ion_auth_acl->is_allowed($v['key'], $users_permissions) ? 'checked' : '' ?>
                                                                   value="1">
                                                            <label for="uPermission_<?= $v['id'] ?>_r1"> </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="icheck-success d-inline">
                                                            <input type="radio" name="uPermission_<?= $v['id'] ?>"
                                                                   id="uPermission_<?= $v['id'] ?>_r2" <?= $this->ion_auth_acl->is_denied($v['key'], $users_permissions) ? 'checked' : '' ?>
                                                                   value="0">
                                                            <label for="uPermission_<?= $v['id'] ?>_r2"> </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="icheck-success d-inline">
                                                            <input type="radio" name="uPermission_<?= $v['id'] ?>"
                                                                   id="uPermission_<?= $v['id'] ?>_r3" <?= $this->ion_auth_acl->is_inherited($v['key'], $users_permissions) || !array_key_exists($v['key'], $users_permissions) ? 'checked' : '' ?>
                                                                   value="X">
                                                            <label for="uPermission_<?= $v['id'] ?>_r3">(Inherit <?php echo ($this->ion_auth_acl->is_inherited($v['key'], $group_permissions, 'value')) ? "Allow" : "Deny"; ?>
                                                                )</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            endforeach;
                                        else:
                                            ?>
                                            <tr>
                                                <td colspan="5" class="text-center">No records found</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-center">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div><!-- /.content --></div><!-- /.content-wrapper -->