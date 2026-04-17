<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Subscriptions</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Subscriptions</li>
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
                            <h4 class="card-title">Subscriptions</h4>
                            <button type="button" class="btn btn-sm btn-primary float-right" onclick="excelEmailDownload()"><i class="fa fa-file-excel"></i> Download</button>

                            <!-- <button type="button" class="btn btn-sm btn-primary float-right" onclick="excelDownload()"><i class="fa fa-file-excel"></i> Download</button> -->
                        </div>
                        <!-- /.card-header -->
                        
                        <div class="card-body">
                            <form action="" id="candidateForm" method="post" style="display: none;">
                                <button class="btn btn-primary" type="submit">submit</button>
                            </form>
                            <div>
                                <table class="table table-bordered table-striped data-table-search-off">
                                    <thead>
                                        <tr>
                                            <th>Sl No.</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($emails) {
                                            foreach ($emails as $key => $email) { ?>
                                                <tr>
                                                    <td><?= $key + 1 ?></td>
                                                    <td><?= $email->email ?></td>
                                                </tr>
                                        <?php }
                                        } ?>


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
<script>
    function excelEmailDownload() {
        // This is to first change the form action to excel page and opens in new tab.
        $('#candidateForm').attr('target', "_blank").attr('action', "<?= site_url('panel/subscription/downloadExcel') ?>").submit();
        // After submit excel download, reset it to candidate list search
        $('#candidateForm').attr('target', "_self").attr('action', "<?= site_url('panel/subscription/all') ?>");
    }
</script>