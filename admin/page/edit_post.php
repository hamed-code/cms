<?php
require_once '../../database/db.php';
require_once '../../js/jdf.php';
$id = $_GET['id'];

if (isset($_POST['sub'])) {

    $title = $_POST['title'];
    $image = $_POST['image'];
    $content = $_POST['content'];
    $tag = $_POST['tag'];
    $writer = $_POST['writer'];

    $result = $conn->prepare("UPDATE `post` SET title = ?, image = ?, content = ?, tag = ?, writer = ?,date = ?WHERE id = ?");
    $result->bindValue(1, $title);
    $result->bindValue(2, $image);
    $result->bindValue(3, $content); 
    $result->bindValue(4, $tag);
    $result->bindValue(5, $writer);
    $result->bindValue(6, jdate('Y/m/d'));
    $result->bindValue(7, $id);
    $result->execute();
    header("Location: blog.php");
}

$all = $conn->prepare("SELECT * FROM writers");
$all->execute();
$writers = $all->fetchAll(PDO::FETCH_ASSOC);

$all = $conn->prepare("SELECT * FROM post WHERE id = ?");
$all->bindValue(1, $id);
$all->execute();
$post = $all->fetch(PDO::FETCH_ASSOC);

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
        <br><br>
        <div class="row">
            <form action="" method="POST">
                <input type="text" name="title" class="form-control" placeholder="عنوان" value="<?= $post['title'] ?>">
                <input type="text" name="image" class="form-control" placeholder="تصویر" value="<?= $post['image'] ?>">
                <textarea placeholder="متن را وارد کنید" name="content" id="editor1"><?= $post['content'] ?></textarea>
                <script>
                    CKEDITOR.replace('editor1');
                </script><br>
                <input type="text" name="tag" class="form-control" placeholder="برچسب ها" value="<?= $post['tag'] ?>">
                <select name="writer" class="form-control">
                    <?php foreach ($writers as $writer) { ?>
                        
                    <option value="<?= $writer['id'] ?>" <?php if($post['writer'] == $writer['id']) { ?> selected <?php } ?>><?= $writer['name'] ?></option>

                    <?php } ?> 
                </select>
                <br>
                <input type="submit" value="ویرایش" name="sub" class="btn btn-primary">
                <a href="blog.php" class="btn btn-danger mb-3">بازگشت</a>
            </form>
        </div>
    </div>

</body>

<script src="../../js/jquery-3.5.1.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>

</html>