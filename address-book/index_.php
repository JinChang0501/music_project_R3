<?php
if (!isset($_SESSION)) {
    session_start();
}


$title = '首頁';
$pageName = 'home';

?>

<?php include __DIR__ . "/part/html-header.php"; ?>
<?php include __DIR__ . "/part/navbar.php"; ?>

<div class="container">
    <h1>Home</h1>
</div>
<?php include __DIR__ . "/part/scripts.php"; ?>
<?php include __DIR__ . "/part/html-footer.php"; ?>