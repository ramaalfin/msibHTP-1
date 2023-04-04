<?php
$title = 'Contact - Admin';
$style = [
    'https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css',
    'css/styles.css',
];
$script = [
    'https://use.fontawesome.com/releases/v6.3.0/js/all.js'
];
include_once('layouts/header.php')
?>

<body class="sb-nav-fixed">
    <?php
    include_once('layouts/sb_topnav.php')
    ?>
    <div id="layoutSidenav">
        <?php 
        include_once('layouts/layout_sidenav.php')
        ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Contact</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Contact</li>
                    </ol>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>

<?php
$src = [
    'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js',
    'js/scripts.js',
    'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js',
    'assets/demo/chart-area-demo.js',
    'assets/demo/chart-bar-demo.js',
    'https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js',
    'js/datatables-simple-demo.js'
];
include_once('layouts/footer.php');

?>