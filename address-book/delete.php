<?php
require __DIR__ . "/admin-required.php";
require __DIR__ . '/../config/pdo-connect.php';

$title = '刪除會員資料';
$pageName = 'delete_member';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if ($sid < 1) {
    header('Location: list.php');
    exit;
}

$sql = "DELETE FROM address_book WHERE sid=$sid";

$pdo->query($sql);

# $_SERVER['HTTP_REFERER']: 從哪個頁面連過來的
$comeFrom = 'list.php';
if (isset($_SERVER['HTTP_REFERER'])) {
    $comeFrom = $_SERVER['HTTP_REFERER'];
}

header("Location: $comeFrom");
