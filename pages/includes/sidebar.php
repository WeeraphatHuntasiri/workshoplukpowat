<?php
$current = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$user = $_SESSION['user'] ?? [];
$displayName = trim(($user['first_name'] ?? 'User') . ' ' . ($user['last_name'] ?? ''));
$status = $user['status'] ?? 'admin';
?>
<nav class="main-header navbar navbar-expand border-bottom navbar-dark bg-info">
  <ul class="navbar-nav"><li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li></ul>
  <ul class="navbar-nav ml-auto"><li class="nav-item"><a class="nav-link" href="../../logout.php" title="Logout"><i class="fas fa-sign-out-alt"></i></a></li></ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="../dashboard/" class="brand-link"><span class="brand-text font-weight-light text-center d-block">Admin Management</span></a>
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image"><img src="../../img/AdminLTELogo.png" class="img-circle elevation-2" alt="User"></div>
      <div class="info"><a href="#" class="d-block"><?= htmlspecialchars($displayName ?: 'User Admin') ?></a><small class="text-muted text-uppercase"><?= htmlspecialchars($status) ?></small></div>
    </div>
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
        <li class="nav-item"><a href="../dashboard/" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/dashboard') !== false ? 'active' : '' ?>"><i class="fas fa-tachometer-alt nav-icon"></i><p>Dashboard</p></a></li>
        <li class="nav-item"><a href="../admin/" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/admin/') !== false ? 'active' : '' ?>"><i class="fas fa-users-cog nav-icon"></i><p>ผู้ใช้งาน</p></a></li>
        <li class="nav-header">ACCOUNT SETTINGS</li>
        <li class="nav-item"><a href="https://github.com/" target="_blank" rel="noopener noreferrer" class="nav-link"><i class="fab fa-github nav-icon"></i><p>Source Code GitHub</p></a></li>
        <li class="nav-item"><a href="../../logout.php" class="nav-link"><i class="fas fa-sign-out-alt nav-icon"></i><p>Logout</p></a></li>
      </ul>
    </nav>
  </div>
</aside>
