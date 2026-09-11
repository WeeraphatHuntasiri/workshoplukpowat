<?php
    require_once __DIR__ . '/php/session_init.php'; //ใช้ session path เดียวกับหน้าอื่น
    session_destroy(); // ลบตัวแปร session ทั้งหมด
    header('location:login.php'); // redirect ไปที่หน้า index.php
?>