<?php

require __DIR__ . './../config/pdo-connect.php';

$per_page = 20; #每頁有幾筆

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

if ($page < 1) {
    header('Location: ?page=1');
    exit;
}

#總筆數
$t_sql = "SELECT COUNT(sid) FROM address_book";

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

# 總頁數
$totalPages = ceil($totalRows / $per_page);
if ($page > $totalPages) {
    header("Location: ?page={$totalPages}");
    exit; # 結束這支程式
}


// SELECT * FROM `address_book` ORDER BY sid DESC LIMIT 0, 20
// SELECT * FROM `address_book` ORDER BY sid DESC LIMIT 20, 20
// SELECT * FROM `address_book` ORDER BY sid DESC LIMIT 40, 20
// SELECT * FROM `address_book` ORDER BY sid DESC LIMIT 60, 20



$sql = sprintf(
    "SELECT * FROM address_book order by sid DESC LIMIT %s,%s",
    ($page - 1) * $per_page,
    $per_page
);

$rows = $pdo->query($sql)->fetchAll();

// echo json_encode([
//     'totalRows' => $totalRows,
//     'totalPages' => $totalPages,
//     'rows' => $rows,
// ]);


include __DIR__ . "/part/html-header.php";
include __DIR__ . "/part/navbar.php";
?>

<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination">

                    <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                        if ($i >= 1 and $i <= $totalPages) : ?>
                            <li class="page-item <?php $page == $i ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                    <?php endif;
                    endfor; ?>
                </ul>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">Email</th>
                        <th scope="col">mobile</th>
                        <th scope="col">birthday</th>
                        <th scope="col">address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <td><?= $r['sid'] ?></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['email'] ?></td>
                            <td><?= $r['mobile'] ?></td>
                            <td><?= $r['birthday'] ?></td>
                            <td><?= $r['address'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>







<?php include __DIR__ . "/part/scripts.php"; ?>
<?php include __DIR__ . "/part/html-footer.php"; ?>