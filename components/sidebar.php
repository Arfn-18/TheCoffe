<div class="col-lg-3">
    <nav class="sidebar navbar navbar-expand-lg bg-body-tertiary rounded mt-3">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start" style="width: 45%;" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">TheCoffe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav nav-pills flex-column justify-content-end flex-grow-1">
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo(isset($_GET['page']) && $_GET['page'] == 'dashboard') ? 'active' : '' ?>" aria-current="page" href="dashboard"><i class="bi bi-house-door"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo(isset($_GET['page']) && $_GET['page'] == 'menu') ? 'active' : '' ?>" aria-current="page" href="menu"><i class="bi bi-grid"></i> Daftar Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo(isset($_GET['page']) && $_GET['page'] == 'category') ? 'active' : '' ?>" aria-current="page" href="#"><i class="bi bi-tags"></i> Kategori Menu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo(isset($_GET['page']) && $_GET['page'] == 'order') ? 'active' : '' ?>" aria-current="page" href="order"><i class="bi bi-bag-dash"></i> Order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo(isset($_GET['page']) && $_GET['page'] == 'dapur') ? 'active' : '' ?>" aria-current="page" href="#"><i class="bi bi-fire"></i> Dapur</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo(isset($_GET['page']) && $_GET['page'] == 'user') ? 'active' : '' ?>" aria-current="page" href="user"><i class="bi bi-person-vcard"></i> User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo(isset($_GET['page']) && $_GET['page'] == 'report') ? 'active' : '' ?>" aria-current="page" href="report"><i class="bi bi-clipboard-data"></i> Report</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>