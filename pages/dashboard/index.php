<?php
include_once('../authen.php');
$total = (int)($conn->query("SELECT COUNT(*) c FROM admin")->fetch_assoc()['c'] ?? 0);
$admins = (int)($conn->query("SELECT COUNT(*) c FROM admin WHERE status='admin'")->fetch_assoc()['c'] ?? 0);
$superadmins = (int)($conn->query("SELECT COUNT(*) c FROM admin WHERE status='superadmin'")->fetch_assoc()['c'] ?? 0);
$result = $conn->query("SELECT id, first_name, last_name, username, status, last_login FROM admin ORDER BY id DESC LIMIT 10");
?>
<!DOCTYPE html><html lang="th"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Dashboard</title>
<link rel="stylesheet" href="../../css/adminlte.min.css"><link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"><link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=swap" rel="stylesheet">
</head><body class="hold-transition sidebar-mini"><div class="wrapper">
<?php include_once('../includes/sidebar.php'); ?>
<div class="content-wrapper"><section class="content-header"><div class="container-fluid"><div class="row mb-2"><div class="col-sm-6"><h1>Dashboard</h1></div><div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item active">Dashboard</li></ol></div></div></div></section>
<section class="content"><div class="container-fluid">
<div class="row">
<div class="col-lg-4 col-6"><div class="small-box bg-info"><div class="inner"><h3><?= $total ?></h3><p>ผู้ใช้งานทั้งหมด</p></div><div class="icon"><i class="fas fa-users"></i></div><a href="../admin/" class="small-box-footer">จัดการผู้ใช้งาน <i class="fas fa-arrow-circle-right"></i></a></div></div>
<div class="col-lg-4 col-6"><div class="small-box bg-success"><div class="inner"><h3><?= $admins ?></h3><p>Admin</p></div><div class="icon"><i class="fas fa-user"></i></div><a href="../admin/" class="small-box-footer">ดูรายการ <i class="fas fa-arrow-circle-right"></i></a></div></div>
<div class="col-lg-4 col-6"><div class="small-box bg-warning"><div class="inner"><h3><?= $superadmins ?></h3><p>Super Admin</p></div><div class="icon"><i class="fas fa-user-shield"></i></div><a href="../admin/" class="small-box-footer">ดูรายการ <i class="fas fa-arrow-circle-right"></i></a></div></div>
</div>
<div class="card"><div class="card-header"><h3 class="card-title">ผู้ใช้งานล่าสุด</h3></div><div class="card-body table-responsive p-0"><table class="table table-hover text-nowrap"><thead><tr><th>ID</th><th>Name</th><th>Username</th><th>Permission</th><th>Last Login</th></tr></thead><tbody>
<?php while($row = $result->fetch_assoc()): ?><tr><td><?= (int)$row['id'] ?></td><td><?= htmlspecialchars($row['first_name'].' '.$row['last_name']) ?></td><td><?= htmlspecialchars($row['username']) ?></td><td><span class="badge badge-<?= $row['status']==='superadmin'?'warning':'primary' ?>"><?= htmlspecialchars($row['status']) ?></span></td><td><?= htmlspecialchars($row['last_login']) ?></td></tr><?php endwhile; ?>
</tbody></table></div></div>
</div></section></div>
<?php include_once('../includes/footer.php'); ?></div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script><script src="../../adminlte.min.js"></script>
</body></html>
