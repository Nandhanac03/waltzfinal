<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark navbar-gray-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= site_url('panel/dashboard') ?>" class="nav-link">Home</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Settings Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" title="<?= $this->session->userdata('username'); ?>">
                        <i class="fas fa-user"></i> <?= $this->session->userdata('identity') ?> <i class="fas fa-caret-down"></i></a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="<?= site_url('panel/user/change_password') ?>" class="dropdown-item"> <i
                                class="fas fa-key mr-2"></i> Change Password </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= site_url('panel/user/logout') ?>" class="dropdown-item"> <i
                                class="fas fa-power-off mr-2"></i> Sign Out </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
