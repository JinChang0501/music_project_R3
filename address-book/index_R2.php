<?php
if (!isset($_SESSION)) {
    session_start();
}


$title = '首頁';
$pageName = 'home';
?>
<style>
    /* .container-85 {
        width: 85%;
        margin: auto;
    } */
</style>



<?php include __DIR__ . "/part/html-header.php"; ?>
<?php include __DIR__ . "/part/navbar-R3.php"; ?>

<?php include __DIR__ . "/part/scripts.php"; ?>
<?php include __DIR__ . "/part/html-footer.php"; ?>