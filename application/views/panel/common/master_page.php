<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $website_title ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/web/images/fevicon.png') ?>" />

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('assets/panel/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?= base_url('assets/panel/plugins/daterangepicker/daterangepicker.css') ?>">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/panel/plugins/datatables-bs4/css/dataTables.bootstrap4.css') ?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('assets/panel/plugins/select2/css/select2.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/panel/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?= base_url('assets/panel/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/panel/plugins/tower-file-input/css/tower-file-input.min.css') ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/panel/dist/css/adminlte.min.css') ?>">
    <!-- Custom style -->
    <link rel="stylesheet" href="<?= base_url('assets/panel/dist/css/panel.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/panel/dist/css/panel_theme.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script>
        const BASE_URL = '<?= base_url() ?>';
    </script>
    <style>
        .navbar-gray-dark {
            background-color: #40679E;
        }

        [class*=sidebar-dark-] {
            background-color: #40679E;
        }

        .card-dark:not(.card-outline) .card-header {
            background-color: #40679E;
        }

        .breadcrumb-item>a {
            text-decoration: none;
        }
    </style>
</head>