<?php

require_once '../../database/db.php';

if ($_SESSION['role'] != 2) {
    header("Location: ../index.php");
}
if (isset($_POST['sub'])) {

    $title = $_POST['title'];
    $image = $_POST['image'];
    $content = $_POST['content'];
    $tag = $_POST['tag'];
    $writer = $_POST['writer'];

    $result = $conn->prepare("INSERT INTO `post` SET title = ?, image = ?, content = ?, tag = ?, writer = ?,date = ?");
    $result->bindValue(1, $title);
    $result->bindValue(2, $image);
    $result->bindValue(3, $content);
    $result->bindValue(4, $tag);
    $result->bindValue(5, $writer);
    $result->bindValue(6, jdate('Y/m/d'));
    $result->execute();
}

$all = $conn->prepare("SELECT * FROM writers");
$all->execute();
$writers = $all->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <title>Admin</title>
    <style>
        input,
        textarea {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <ul class="nav nav-pills nav-fill">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../page/menu.php">منو</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">وبلاگ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../page/comment.php">نویسندگان</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
        </div>
        <br><br>
        <div class="row">
            <form action="" method="POST">
                <input type="text" name="title" class="form-control" placeholder="عنوان">
                <input type="text" name="image" class="form-control" placeholder="تصویر">
                <textarea placeholder="متن را وارد کنید" name="content" id="editor1"></textarea>
                <script>
                    CKEDITOR.replace('editor1');
                </script><br>
                <input type="text" name="tag" class="form-control" placeholder="برچسب ها">
                <select name="writer" class="form-control">
                    <?php foreach ($writers as $writer) { ?>

                        <option value="<?= $writer['id'] ?>"><?= $writer['name'] ?></option>

                    <?php } ?>
                </select>
                <br>
                <input type="submit" value="ثابت" name="sub" class="btn btn-primary">
            </form>
        </div>
    </div>

</body>

<script src="../../js/jquery-3.5.1.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>

</html>