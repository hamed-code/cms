<?php

require_once '../../database/db.php';

if ($_SESSION['role'] != 2) {
    header("Location: ../index.php");
}
$id = $_GET['id'];
if (isset($_POST['sub'])) {
    $title = $_POST['title'];
    $sort = $_POST['sort'];
    $rd = $_POST['rd'];         //status

    $result = $conn->prepare("UPDATE menu SET title = ?, sort = ?, status = ? WHERE id = ?");
    $result->bindValue(1, $title);
    $result->bindValue(2, $sort);
    $result->bindValue(3, $rd);
    $result->bindValue(4, $id);
    $result->execute();
    header("Location: menu.php");
}

$all = $conn->prepare("SELECT * FROM menu WHERE id = ?");
$all->bindValue(1, $id);
$all->execute();
$menu = $all->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <title>Admin</title>
</head>

<body>

    <div class="container">
        <div class="row">
        </div>
        <div class="row" style="padding: 30px;">
            <form method="POST"><br>
                <input type="text" name="title" placeholder="عنوان" class="form-control" value="<?= $menu['title'] ?>"><br>
                <input type="number" name="sort" placeholder="الویت بندی" class="form-control" value="<?= $menu['sort'] ?>">
                <div class="form-check form-switch">
                    <div class="custom-control custom-radio"><br>
                        <input type="radio" value="1" id="customRadio1" name="rd" class="custom-control-input" <?php if ($menu['status'] == 1) { ?> checked <?php } ?>>
                        <label class="custom-control-label" for="customRadio1">فعال</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" value="0" id="customRadio2" name="rd" class="custom-control-input" <?php if ($menu['status'] == 0) { ?> checked <?php } ?>>
                        <label class="custom-control-label" for="customRadio2">غیر فعال</label>
                    </div>
                </div> <br>
                <input type="submit" name="sub" class="btn btn-primary" value="ثبت">
                <a href="menu.php" class="btn btn-danger">بازگشت</a>
            </form> <br><br>
        </div>
    </div>

</body>

<script src="../../js/jquery-3.5.1.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>

</html>