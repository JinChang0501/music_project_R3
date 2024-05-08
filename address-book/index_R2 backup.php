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
    .logo {
        width: 200px;
        height: 70px;
        background-color: aliceblue;
    }
</style>



<?php include __DIR__ . "/part/html-header.php"; ?>


<div class="container-fluid py-3 p-2" style="background-color: #7B7B7B;">
    <div class="logo ms-3"><img src="" alt=""></div>
    <!-- <h1>Home</h1> -->
</div>
<?php include __DIR__ . "/part/navbar-R3.php"; ?>

<?php include __DIR__ . "/part/scripts.php"; ?>
<?php include __DIR__ . "/part/html-footer.php"; ?>