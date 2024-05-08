<?php
if (!isset($_SESSION)) {
  session_start();
}


$title = '通訊錄列表';
$pageName = 'list';

require __DIR__ . './../config/pdo-connect.php';

$per_page = 20; #每頁有幾筆

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

if ($page < 1) {
  header('Location: ?page=1');
  exit;
}

#總筆數
$t_sql = "SELECT COUNT(id) FROM members";


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
  "SELECT * FROM members order by id asc LIMIT %s,%s",
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
          <!-- arrow left start -->
          <li class="page-item ">
            <a class="page-link" href="#">
              <i class="fa-solid fa-angles-left"></i>
            </a>
          </li>
          <li class="page-item ">
            <a class="page-link" href="#">
              <i class="fa-solid fa-angle-left"></i>
            </a>
          </li>
          <!-- arrow left end -->
          <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
            if ($i >= 1 and $i <= $totalPages) : ?>
              <li class="page-item <?php $page == $i ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
              </li>
          <?php endif;
          endfor; ?>
          <!-- arrow right start -->
          <li class="page-item">
            <a class="page-link" href="#">
              <i class="fa-solid fa-angle-right"></i>
            </a>
          </li>
          <li class="page-item">
            <a class="page-link" href="#">
              <i class="fa-solid fa-angles-right"></i>
            </a>
          </li>
          <!-- arrow right end -->
        </ul>
      </nav>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th scope="col"><i class="fa-solid fa-trash"></i></th>
            <th scope="col">#</th>
            <th scope="col">first_name</th>
            <th scope="col">last_name</th>
            <th scope="col">Email</th>
            <th scope="col">gender</th>
            <th scope="col">phone_number</th>
            <th scope="col">birthday</th>
            <th scope="col">address</th>
            <th scope="col">created_at</th>
            <!-- 避免xss  strip_tags/htmlentities-->
            <th scope="col"><i class="fa-solid fa-pen-to-square"></i></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rows as $r) : ?>
            <tr>
              <td><a href="javascript: deleteOne(<?= $r['id'] ?>)"><i class="fa-solid fa-trash"></i></a></td>
              <td><?= $r['id'] ?></td>
              <td><?= $r['first_name'] ?></td>
              <td><?= $r['last_name'] ?></td>
              <td><?= $r['email'] ?></td>
              <td><?= $r['gender'] ?></td>
              <td><?= $r['phone_number'] ?></td>
              <td><?= $r['birthday'] ?></td>
              <td><?= htmlentities($r['address']) ?></td>
              <td><?= $r['created_at'] ?></td>
              <td><a href="edit.php?id=<?= $r['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include __DIR__ . "/part/scripts.php" ?>
<script>
  const deleteOne = (id) => {
    if (confirm(`確定要刪除${id}的資料嗎?`)) {
      location.href = `delete.php?id=${id}`;
    }
  }
</script>

<?php include __DIR__ . "/part/html-footer.php" ?>