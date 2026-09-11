<?php
require_once __DIR__ . '/../php/session_init.php';
require_once __DIR__ . '/../php/connect.php';
if (!isset($_SESSION['authen_id'], $_SESSION['user'])) {
    header('Location: ../../login.php');
    exit;
}
