<?php

require_once '../../database/db.php';

if ($_SESSION['role'] != 2) {
    header("Location: ../index.php");
}
if (isset($_POST['sub'])) {

    $name = $_POST['name'];
    $result = $conn->prepare("INSERT INTO `writers` SET name = ?");
    $result->bindValue(1, $name);
    $result->execute();
}

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
            <ul class="nav nav-pills nav-fill">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../page/menu.php">منو</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../page/blog.php">وبلاگ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">نویسندگان</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
        </div><br>
        <div class="row">
            <form method="POST"><br>
                <input type="text" name="name" placeholder="نام و نام خانوادگی" class="form-control"><br>
                <input type="submit" name="sub" class="btn btn-primary" value="ثبت">
            </form> <br><br>
        </div>
    </div>

</body>

<script src="../../js/jquery-3.5.1.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>

</html>