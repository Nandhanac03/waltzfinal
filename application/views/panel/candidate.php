<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Candidates</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Candidates</li>
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
                        <div class="card-header" style="display: none;">
                            <h4 class="card-title">Candidate Details</h4>
                            <?php if ($controller_config['disable_candidate_add'] != TRUE) : ?>
                                <a href="<?= site_url('panel/candidate/add') ?>" class="btn btn-sm btn-info float-right" title="Add"><i class="fas fa-user-plus"></i> Add</a>
                            <?php endif; ?>
                            <button type="button" class="btn btn-sm btn-primary float-right" onclick="excelDownload()"><i class="fa fa-file-excel"></i> Download</button>
                        </div>
                        <!-- /.card-header -->
                        <!-- <?php echo "<pre>";
                                print_r($_POST);
                                echo "</pre>"; ?> -->
                        <div class="card-body">
                            <form role="form" method="post" action="<?= site_url('panel/candidate/all') ?>" id="candidateForm">
                                <div class="row mt-2 mb-4">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="filterCandidateTitle" placeholder="Candidate Name" name="filterCandidateTitle" value="<?= set_value('filterCandidateTitle') ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <select class="form-control" id="filterCandidatePost" name="filterCandidatePost">
                                                <option value="">Select Post</option>
                                                <?php
                                                foreach ($careers as $career) {
                                                ?>
                                                    <option value="<?= $career->id ?>" <?= (isset($_POST['filterCandidatePost']) && ((int) $_POST['filterCandidatePost'] == (int) $career->id)) ? 'selected' : '' ?>><?= $career->title ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary float-left">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div>
                                <table class="table table-bordered table-striped data-table-search-off">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Candidate Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Post applied for </th>
                                            <th>Date applied</th>
                                            <th>Resume</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($applied_candidates) {
                                            foreach (array_reverse($applied_candidates) as $key => $candidates) { ?>
                                                <tr>
                                                    <td><?= $key + 1 ?></td>
                                                    <td><?= htmlspecialchars($candidates->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                                    <td><?= htmlspecialchars($candidates->email, ENT_QUOTES, 'UTF-8'); ?></td>
                                                    <td><?= htmlspecialchars($candidates->phone, ENT_QUOTES, 'UTF-8'); ?></td>
                                                    <td><?= htmlspecialchars($candidates->job_title, ENT_QUOTES, 'UTF-8'); ?></td>
                                                    <td><?= htmlspecialchars(date('d-m-Y H:i', $candidates->created_at), ENT_QUOTES, 'UTF-8'); ?></td>
                                                    <td>
                                                        <a href="<?= site_url('assets/uploads/resume/' . $candidates->resume_cover) ?>" target="_blank" class="btn btn-outline-danger rounded-pill border-0"><i class="fas fa-file-pdf"></i></a>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn-sm btn-danger trigger_alert_modal" data-title="Confirm" data-desc="Are you sure want to delete this?" data-redirect="<?= site_url('panel/candidate/delete_candidate/' . $candidates->id) ?>" title='Delete'><i class="fas fa-trash-alt"></i></a>
                                                    </td>
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
    function excelDownload() {
        // This is to first change the form action to excel page and opens in new tab.
        $('#candidateForm').attr('target', "_blank").attr('action', "<?= site_url('panel/candidate/downloadExcel') ?>").submit();
        // After submit excel download, reset it to candidate list search
        $('#candidateForm').attr('target', "_self").attr('action', "<?= site_url('panel/candidate/all') ?>");
    }
</script>