<?php

    require_once '../../database/db.php';

    if(isset($_POST['sub'])){

        $title = $_POST['title'];
        $sort = $_POST['sort'];
        $rd = $_POST['rd'];         //status

        $result = $conn->prepare("INSERT INTO `menu` SET title = ?, sort = ?, status = ?");
        $result->bindValue(1, $title);
        $result->bindValue(2, $sort);
        $result->bindValue(3, $rd);
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
                    <a class="nav-link active" aria-current="page" href="#">منو</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../page/blog.php">وبلاگ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../page/comment.php">کامنت</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
        </div>
        <div class="row" style="padding: 30px;">
            <form method="POST"><br>
                <input type="text" name="title" placeholder="عنوان" class="form-control"><br>
                <input type="number" name="sort" placeholder="الویت بندی" class="form-control">
                <div class="form-check form-switch">
                    <div class="custom-control custom-radio"><br>
                        <input type="radio" value="1" id="customRadio1" name="rd" class="custom-control-input" checked>
                        <label class="custom-control-label" for="customRadio1">فعال</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" value="0" id="customRadio2" name="rd" class="custom-control-input">
                        <label class="custom-control-label" for="customRadio2">غیر فعال</label>
                    </div>
                </div> <br>
                <input type="submit" name="sub" class="btn btn-primary" value="ثبت">
            </form>
        </div>
    </div>

</body>

<script src="../../js/jquery-3.5.1.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>

</html>