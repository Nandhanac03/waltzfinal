<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Candidate</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('panel/candidate/all') ?>">Candidate</a></li>
                        <li class="breadcrumb-item active">Candidate</li>
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
                            <h3 class="card-title">Candidate Details</h3>
                            
                        </div>
                        <!-- /.card-header -->
                        
                        <!-- form start -->

                        <form>
                            <div class="card-body">
                            <ol class="breadcrumb float-sm-right">
                        
                        <?php if($prev_val>0){?>
                            <li class="breadcrumb-item"><a href="<?= site_url('panel/candidate/view/'.$prev_val) ?>">Prev</a></li>
                        <?php }else{?>
                            <li class="breadcrumb-item" ><a href="#" style="color: #ccc;">Prev</a></li>
                        <?php }?>

                        <?php if($next_val>0){?>
                            <li class="breadcrumb-item"><a href="<?= site_url('panel/candidate/view/'.$next_val) ?>">Next</a></li>
                        <?php }else{?>
                            <li class="breadcrumb-item" ><a href="#" style="color: #ccc;">Next</a></li>
                        <?php }?>
                    </ol>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Applied Post</label>
                                        <p><?= $candidates->post ?></p>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-12">
                                        <label>Name</label>
                                        <p><?= $candidates->full_name ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Nationality</label>
                                        <p><?= ($candidates->country) ? $country_list[$candidates->country] : '' ?></p>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label>Mobile With WhatsApp</label>
                                         <p><?php if($candidates->phonecode){ echo $candidates->phonecode;?> - <?php }?> <?= $candidates->phone ?></p>
                                        <!--<p><?= $candidates->phone ?></p>-->
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-12">
                                        <label>Email</label>
                                        <p><?= $candidates->email ?></p>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label>Address</label>
                                        <p><?= ($candidates->address) ? $candidates->address : '' ?></p>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <label>Current Location</label>
                                        <p><?= ($candidates->current_loc) ? $candidates->current_loc : '' ?></p>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-12">
                                        <label>Gender</label>
                                        <p><?= $candidates->gender ?></p>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label>Highest Degree</label>
                                        <p><?= ($candidates->company) ? $candidates->company : '' ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Job Role</label>
                                        <p><?= ($candidates->job_role) ? $candidates->job_role : '' ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Year of experience</label>
                                        <p><?= ($candidates->experience) ? $candidates->experience : '' ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Created At</label>
                                        <p><?= date('d-m-Y H:i', strtotime($candidates->created_at)) ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Resume</label>
                                        <p>
                                            <a href="<?= base_url("assets/uploads/career/") . htmlspecialchars($candidates->resume, ENT_QUOTES, 'UTF-8'); ?>" class="btn-sm btn-primary" target="_blank">
                                                <i class="fa fa-download"></i>
                                            </a>
                                        </p>
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