<?php
include_once('../authen.php');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: index.php'); exit; }
$first = trim($_POST['first_name'] ?? ''); $last = trim($_POST['last_name'] ?? ''); $username = trim($_POST['username'] ?? ''); $password = $_POST['password'] ?? ''; $status = $_POST['status'] ?? '';
if ($first === '' || $last === '' || $username === '' || $password === '' || !in_array($status, ['admin','superadmin'], true)) { $_SESSION['flash']=['icon'=>'error','title'=>'กรุณากรอกข้อมูลให้ครบถ้วน','showConfirmButton'=>true]; header('Location: form-create.php'); exit; }
$stmt=$conn->prepare('SELECT id FROM admin WHERE username=? LIMIT 1'); $stmt->bind_param('s',$username); $stmt->execute(); if($stmt->get_result()->fetch_assoc()){ $_SESSION['flash']=['icon'=>'error','title'=>'Username นี้มีอยู่แล้ว','showConfirmButton'=>true]; header('Location: form-create.php'); exit; }
$hash=password_hash($password,PASSWORD_DEFAULT); $stmt=$conn->prepare('INSERT INTO admin(first_name,last_name,username,password,status,last_login,updated_at,creat_at) VALUES(?,?,?,?,?,NOW(),NOW(),NOW())'); $stmt->bind_param('sssss',$first,$last,$username,$hash,$status);
if($stmt->execute()) $_SESSION['flash']=['icon'=>'success','title'=>'เพิ่มผู้ใช้งานสำเร็จ','showConfirmButton'=>false,'timer'=>1500]; else $_SESSION['flash']=['icon'=>'error','title'=>'ไม่สามารถเพิ่มข้อมูลได้'];
header('Location: index.php'); exit;
