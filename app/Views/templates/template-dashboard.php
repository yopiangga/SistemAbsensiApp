<?php
$UserModel = new \App\Models\UserModel;
$dUser = $UserModel->find(session('id'))
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= isset($title) ? $title : 'AbsensiApp - Management' ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendors/core/core.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/fonts/feather-font/css/iconfont.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/vendors/DataTables/datatables.min.css" /> -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendors/datatables.net-bs4/dataTables.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/datatables/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/datatables/responsive.dataTables.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/demo_1/style.css">
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/images/favicon.png" />
</head>

<body>
    <div class="main-wrapper">
        <?php $db = \Config\Database::connect();
        $request = \Config\Services::request();
        $tbl_menu = $db->table('tbl_menu');
        $tbl_sub_menu = $db->table('tbl_sub_menu');
        $tbl_user = $db->table('tbl_user');
        $isUser = $tbl_user->where('id_user', session('id'))->get()->getRowArray();
        $role_id = $isUser['role_id'];
        $menus = $tbl_menu->select('tbl_menu.*')->join('tbl_role_access', 'tbl_role_access.menu_id = tbl_menu.id_menu')->where(['is_active' => '1', 'role_id' => $role_id])->orderBy('no_serial', 'ASC')->get()->getResultArray(); ?>
        <nav class="sidebar">
            <div class="sidebar-header">
                <a href="#" class="sidebar-brand">
                    Absensi<span>App</span>
                </a>
                <div class="sidebar-toggler not-active">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="sidebar-body">
                <ul class="nav">
                    <?php foreach ($menus as $menu) :
                        if (!$menu['url'] == null) : ?>
                            <li class="nav-item nav-category">Main</li>
                            <li class="nav-item <?= $request->uri->getSegment(1) == $menu['url'] ? 'active' : ''  ?>">
                                <a href="<?= base_url() . '/' . $menu['url'] ?>" class="nav-link">
                                    <i class="link-icon" data-feather="<?= $menu['icon'] ? $menu['icon'] : 'box' ?>"></i>
                                    <span class="link-title"><?= $menu['menu'] ?></span>
                                </a>
                            </li>
                        <?php else :
                            $urlsubmenus = $tbl_sub_menu->where('menu_id', $menu['id_menu'])->get()->getResultArray();
                            $urlsubmenu = [];
                            foreach ($urlsubmenus as $result) {
                                $urlsubmenu[] = $result['url'];
                            }; ?>
                            <li class="nav-item nav-category"><?= $menu['menu'] ?></li>
                            <?php $submenus = $tbl_sub_menu->where(['menu_id' => $menu['id_menu'], 'is_active' => '1'])->orderBy('no_serial', 'ASC')->get()->getResultArray();
                            foreach ($submenus as $submenu) : ?>
                                <li class="nav-item <?= $request->uri->getSegment(1) == $submenu['url'] ? 'active' : ''  ?>">
                                    <a href="<?= base_url() . '/' . $submenu['url'] ?>" class="nav-link">
                                        <i class="link-icon" data-feather="<?= $submenu['icon'] ? $submenu['icon'] : 'box' ?>"></i>
                                        <span class="link-title"><?= $submenu['title'] ?> </span>
                                    </a>
                                </li>
                            <?php endforeach ?>
                    <?php endif;
                    endforeach ?>
                    <li class="nav-item nav-category">Personal</li>
                    <li class="nav-item">
                        <a href="<?= base_url("/auth/logout") ?>" class="nav-link">
                            <i class="link-icon" data-feather="log-out"></i>
                            <span class="link-title">Keluar</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="page-wrapper">

            <nav class="navbar">
                <a href="#" class="sidebar-toggler">
                    <i data-feather="menu"></i>
                </a>
                <div class="navbar-content">
                    <ul class="navbar-nav">

                        <li class="nav-item dropdown nav-profile">
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?= base_url() ?>/assets/images/faces/face1.jpg" alt="profile">
                            </a>
                            <div class="dropdown-menu" aria-labelledby="profileDropdown">
                                <div class="dropdown-header d-flex flex-column align-items-center">
                                    <div class="figure mb-3">
                                        <img src="<?= base_url() ?>/assets/images/faces/face1.jpg" alt="">
                                    </div>
                                    <div class="info text-center">
                                        <p class="name font-weight-bold mb-0"> <?= $dUser['display_name'] ?> </p>
                                        <p class="email text-muted mb-3"><?= $dUser['username'] ?></p>
                                    </div>
                                </div>
                                <div class="dropdown-body">
                                    <ul class="profile-nav p-0 pt-3">
                                        <li class="nav-item">
                                            <a href="<?= base_url("/auth/logout") ?>" class="nav-link">
                                                <i data-feather="log-out"></i>
                                                <span>Keluar</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="page-content">
                <?php $this->renderSection('content'); ?>
            </div>

            <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-center">
                <p class="text-muted text-center text-md-left">Copyright &copy; <?= date('Y') ?> <span class="text-primary">TeamHIY </span> All rights reserved</p>
            </footer>

        </div>
    </div>

    <script src="<?= base_url() ?>/assets/vendors/core/core.js"></script>
    <script src="<?= base_url() ?>/assets/vendors/chartjs/Chart.min.js"></script>
    <script src="<?= base_url() ?>/assets/vendors/jquery.flot/jquery.flot.js"></script>
    <script src="<?= base_url() ?>/assets/vendors/jquery.flot/jquery.flot.resize.js"></script>
    <script src="<?= base_url() ?>/assets/vendors/inputmask/jquery.inputmask.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/inputmask.js"></script>
    <script src="<?= base_url() ?>/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url() ?>/assets/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="<?= base_url() ?>/assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="<?= base_url() ?>/assets/vendors/feather-icons/feather.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/template.js"></script>
    <script src="<?= base_url() ?>/assets/js/dashboard.js"></script>
    <script src="<?= base_url() ?>/assets/js/datepicker.js"></script>
    <!-- <script type="text/javascript" src="<?= base_url() ?>/assets/vendors/DataTables/datatables.min.js"></script> -->
    <script src="<?= base_url() ?>/assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="<?= base_url() ?>/assets/js/data-table.js"></script>
    <script src="<?= base_url() ?>/assets/vendors/datatables.net/dataTables.buttons.min.js"></script>
    <script src="<?= base_url() ?>/assets/vendors/datatables.net/buttons.print.min.js"></script>
    <script src="<?= base_url() ?>/assets/ajax/jszip.min.js"></script>
    <script src="<?= base_url() ?>/assets/ajax/pdfmake.min.js"></script>
    <script src="<?= base_url() ?>/assets/ajax/vfs_fonts.js"></script>
    <script src="<?= base_url() ?>/assets/ajax/buttons.html5.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/datatables/dataTables.rowReorder.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/datatables/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table-1').DataTable({
                dom: 'Blfrtip',
                buttons: [{
                        extend: 'csv'
                    },
                    {
                        extend: 'pdf',
                    },
                    {
                        extend: 'excel',
                    },
                    {
                        extend: 'print',
                    },
                ]
            });
        });
    </script>
</body>

</html>