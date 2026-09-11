<?php
include_once('../authen.php');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: index.php'); exit; }
$id=(int)($_POST['id']??0); $first=trim($_POST['first_name']??''); $last=trim($_POST['last_name']??''); $status=$_POST['status']??''; $password=$_POST['password']??'';
if($id<1 || $first==='' || $last==='' || !in_array($status,['admin','superadmin'],true)){ $_SESSION['flash']=['icon'=>'error','title'=>'ข้อมูลไม่ถูกต้อง']; header('Location: index.php'); exit; }
if($id === (int)$_SESSION['authen_id'] && $status !== 'superadmin'){ $_SESSION['flash']=['icon'=>'error','title'=>'ไม่สามารถลดสิทธิ์บัญชีที่กำลังใช้งานอยู่ได้']; header('Location: form-edit.php?id='.$id); exit; }
if($password!=='') { $hash=password_hash($password,PASSWORD_DEFAULT); $stmt=$conn->prepare('UPDATE admin SET first_name=?,last_name=?,status=?,password=?,updated_at=NOW() WHERE id=?'); $stmt->bind_param('ssssi',$first,$last,$status,$hash,$id); }
else { $stmt=$conn->prepare('UPDATE admin SET first_name=?,last_name=?,status=?,updated_at=NOW() WHERE id=?'); $stmt->bind_param('sssi',$first,$last,$status,$id); }
if($stmt->execute()){ if($id === (int)$_SESSION['authen_id']){ $_SESSION['user']['first_name']=$first; $_SESSION['user']['last_name']=$last; $_SESSION['user']['status']=$status; } $_SESSION['flash']=['icon'=>'success','title'=>'แก้ไขข้อมูลสำเร็จ','showConfirmButton'=>false,'timer'=>1500]; } else $_SESSION['flash']=['icon'=>'error','title'=>'ไม่สามารถแก้ไขข้อมูลได้'];
header('Location: index.php'); exit;
