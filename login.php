<?php
require_once __DIR__ . '/php/session_init.php';
require_once __DIR__ . '/php/connect.php';

if (isset($_SESSION['authen_id'])) {
    header('Location: pages/dashboard/');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'กรุณากรอก Username และ Password';
    } else {
        $stmt = $conn->prepare('SELECT id, first_name, last_name, username, password, status FROM admin WHERE username = ? LIMIT 1');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['authen_id'] = (int)$user['id'];
            $_SESSION['user'] = [
                'id' => (int)$user['id'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'username' => $user['username'],
                'status' => $user['status']
            ];

            $update = $conn->prepare('UPDATE admin SET last_login = NOW() WHERE id = ?');
            $update->bind_param('i', $user['id']);
            $update->execute();

            header('Location: pages/dashboard/');
            exit;
        }
        $error = 'Username หรือ Password ไม่ถูกต้อง';
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Admin Management</title>
  <link rel="stylesheet" href="css/adminlte.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=swap" rel="stylesheet">
  <style>
body{font-family:'Source Sans Pro',sans-serif}
.login-card-body{border-radius:.25rem}
.brand-title{font-weight:300}
.demo-credentials{background:#f8f9fa;border:1px solid #dee2e6;border-radius:.35rem;padding:12px;margin-top:16px}
.demo-credentials code{font-size:1rem}
.github-btn{margin-top:10px}
</style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo"><a href="login.php" class="brand-title"><b>Admin</b> Management</a></div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">เข้าสู่ระบบผู้ดูแล</p>
      <?php if ($error): ?>
        <div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle mr-1"></i><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>
      <form method="post" action="">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="username" required>
          <div class="input-group-append"><div class="input-group-text"><span class="fas fa-user"></span></div></div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="current-password" required>
          <div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
      </form>
      <div class="demo-credentials">
        <div class="font-weight-bold mb-1"><i class="fas fa-key mr-1"></i>บัญชีสำหรับเข้าสู่ระบบ</div>
        <div>Username: <code>test</code></div>
        <div>Password: <code>1234567</code></div>
      </div>
      <a href="https://github.com/tek-33/9-9-69" target="_blank" rel="noopener noreferrer" class="btn btn-dark btn-block github-btn">
        <i class="fab fa-github mr-1"></i> Source Code GitHub
      </a>
      <p class="text-center text-muted small mt-3 mb-0">&copy; <?= date('Y') ?> weeraphat</p>
    </div>
  </div>
</div>
</body>
</html>
