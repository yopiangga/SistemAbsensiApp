<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Masuk - AbsensiApp</title>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendors/core/core.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/fonts/feather-font/css/iconfont.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/demo_1/style.css">
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/images/favicon.png" />
</head>

<body>

    <?php $this->renderSection('content'); ?>

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/assets/vendors/core/core.js"></script>
    <script src="<?= base_url() ?>/assets/vendors/feather-icons/feather.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/template.js"></script>
    <?php $this->renderSection('script'); ?>

</body>

</html>