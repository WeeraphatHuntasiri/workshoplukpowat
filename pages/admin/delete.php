<?php
include_once('../authen.php');
$id=(int)($_GET['id']??0);
if($id<1 || $id === 1 || $id === (int)$_SESSION['authen_id']) { $_SESSION['flash']=['icon'=>'error','title'=>'ไม่สามารถลบบัญชีนี้ได้']; header('Location: index.php'); exit; }
$stmt=$conn->prepare('DELETE FROM admin WHERE id=?'); $stmt->bind_param('i',$id);
if($stmt->execute() && $stmt->affected_rows>0) $_SESSION['flash']=['icon'=>'success','title'=>'ลบข้อมูลสำเร็จ','showConfirmButton'=>false,'timer'=>1500]; else $_SESSION['flash']=['icon'=>'error','title'=>'ไม่พบข้อมูลที่ต้องการลบ'];
header('Location: index.php'); exit;
