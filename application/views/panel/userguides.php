<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Userguide Management</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Userguide</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Style for professional look -->
    <style>
        .manage-card {
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: none;
        }
        .manage-card .card-header {
            background-color: #ffffff;
            border-bottom: 1px solid #f1f5f9;
            padding: 1.25rem 1.5rem;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        .manage-card .card-title {
            font-weight: 700;
            color: #1e293b;
            font-size: 1.25rem;
        }
        .btn-add-pro {
            background: linear-gradient(90deg, #3b82f6 0%, #2563eb 100%);
            border: none;
            padding: 0.5rem 1.25rem;
            border-radius: 8px;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
            transition: all 0.2s ease;
        }
        .btn-add-pro:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(37, 99, 235, 0.3);
            color: #fff;
        }
        .table-pro thead th {
            background-color: #f8fafc;
            color: #64748b;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            border-top: none;
            border-bottom: 2px solid #e2e8f0;
            padding: 1rem 1.5rem;
        }
        .table-pro tbody td {
            padding: 1.25rem 1.5rem;
            vertical-align: middle;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
        }
        .badge-pro {
            padding: 0.5em 1em;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.75rem;
        }
        .btn-action {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            margin-right: 5px;
            transition: all 0.2s ease;
        }
    </style>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?= $alert ?>
                    <div class="card manage-card">
                        <div class="card-header d-flex align-items-center">
                            <h4 class="card-title mb-0">Existing Userguides</h4>
                            <div class="ml-auto">
                                <?php if ($controller_config['disable_userguide_add'] != TRUE) : ?>
                                   
                                     <a href="<?= site_url('panel/userguide/add') ?>" class="btn btn-sm btn-info btn-add-pro" title="Add New Guide"><i class="fas fa-plus mr-2"></i> Create New Guide</a> 
                                
                               
                                    <?php endif; ?>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="p-4">
                                <form role="form" method="post" action="<?= site_url('panel/userguide/all') ?>">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="filterTitle" placeholder="Search by title..." name="filterTitle" value="<?= set_value('filterTitle') ?>" style="border-radius: 8px 0 0 8px;">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-primary" style="border-radius: 0 8px 8px 0;">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-pro mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 80px;">#</th>
                                            <th>Guide Title</th>
                                            <th>Created Date</th>
                                            <th style="width: 150px;">Status</th>
                                            <th style="text-align: right; width: 150px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($userguides) : $i = 0;
                                            foreach ($userguides as $guide) : $i++;
                                        ?>
                                                <tr>
                                                    <td><span class="text-muted font-weight-bold"><?= $i ?></span></td>
                                                    <td>
                                                        <div class="font-weight-600"><?= htmlspecialchars($guide->title, ENT_QUOTES, 'UTF-8'); ?></div>
                                                        <small class="text-muted"><?= $guide->title_slug ?></small>
                                                    </td>
                                                    <td>
                                                        <div class="text-sm"><?= htmlspecialchars(date('d M Y', $guide->created_at), ENT_QUOTES, 'UTF-8'); ?></div>
                                                        <small class="text-muted"><?= date('H:i', $guide->created_at) ?></small>
                                                    </td>
                                                    <td>
                                                        <span class="badge-pro badge-<?= htmlspecialchars($guide->active == '1' ? 'success' : 'danger', ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars($guide->active == '1' ? 'Active' : 'Inactive', ENT_QUOTES, 'UTF-8'); ?></span>
                                                    </td>
                                                    <td style="text-align: right;">
                                                        <a href="<?= site_url('panel/userguide/edit/' . $guide->id) ?>" title='Edit' class="btn-action btn-primary"><i class="fas fa-edit"></i></a>
                                                        
                                                        
                                                        
                                                        <!-- <a href="<?= site_url('panel/userguide/delete/' . $guide->id) ?>" title='Delete' class="btn-action btn-danger" onclick="return confirm('Are you sure you want to delete this guide?')"><i class="fas fa-trash"></i></a> -->
                                                   
                                                   
                                                    </td>
                                                </tr>
                                        <?php
                                            endforeach;
                                        else:
                                        ?>
                                            <tr>
                                                <td colspan="5" class="text-center py-5">
                                                    <div class="text-muted">
                                                        <i class="fas fa-folder-open fa-3x mb-3"></i>
                                                        <p>No guides found matching your criteria.</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        endif;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div><!-- /.content-wrapper -->
