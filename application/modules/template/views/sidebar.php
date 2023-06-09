<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas  fa-laptop"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SPK - FRANCHISE</div>
    </a>
    <hr class="sidebar-divider ">
    <?php
    $role_id = $this->session->userdata('role_id');
    $queryMenu = "SELECT a.menu_id, a.menu_nm, a.parent_id
                    FROM menu a 
                    LEFT JOIN user_access b ON a.menu_id =b.menu_id
                    WHERE b.role_id = $role_id AND a.parent_id is null
                    ORDER BY b.menu_id ASC
                    ";
    $menu = $this->db->query($queryMenu)->result_array();
    ?>
    <?php foreach ($menu as $m) : ?>
        <div class="sidebar-heading">
            <?= @$m['menu_nm'] ?>
        </div>
        <?php
        $menu_id =  @$m['menu_id'];
        $role_id = $this->session->userdata('role_id');
        $queryMenu = "SELECT a.*
                    FROM menu a 
                    LEFT JOIN user_access b ON a.menu_id =b.menu_id
                    WHERE b.role_id = $role_id AND a.parent_id =  $menu_id
                    ORDER BY b.menu_id ASC
                    ";
        $access = $this->db->query($queryMenu)->result_array();
        ?>
        <?php foreach ($access as $sm) : ?>
            <?php if ($title == $sm['menu_nm']) : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>
                <a class="nav-link pb-0" href="<?= base_url('index.php/' . @$sm['url']); ?>">
                    <span><?= @$sm['menu_nm']; ?></span></a>
                </li>
            <?php endforeach; ?>
            <hr class="sidebar-divider mt-3">
        <?php endforeach; ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('index.php/auth/login/logout'); ?>">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>
        <hr class="sidebar-divider d-none d-md-block">
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
</ul>
<!-- End of Sidebar -->