<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $website_title ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="<?= base_url('assets/dist/img/favicon.png') ?>"/>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= base_url('assets/panel/plugins/fontawesome-free/css/all.min.css') ?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="<?= base_url('assets/panel/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= base_url('assets/panel/dist/css/adminlte.min.css') ?>">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <!-- Custom style -->
        <link rel="stylesheet" href="<?= base_url('assets/panel/dist/css/panel.css') ?>">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="./"><img src="<?= base_url('assets/panel/dist/img/logo.png') ?>" alt="Logo" width="150"></a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Forgot my password</p>
                    <form action="<?= site_url('panel/user/forgot_password') ?>" method="post">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Enter user email" name="identity" value="">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            <?php echo form_error('identity'); ?>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <!-- /.social-auth-links -->
                    <?= $alert ?>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->
        <!-- jQuery -->
        <script src="<?= base_url('assets/panel/plugins/jquery/jquery.min.js') ?>"></script>
        <!-- Bootstrap 4 -->
        <script src="<?= base_url('assets/panel/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
        <!-- AdminLTE App -->
        <script src="<?= base_url('assets/panel/dist/js/adminlte.min.js') ?>"></script>
    </body>
</html>
