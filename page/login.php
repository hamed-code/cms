<?php

require_once '../database/db.php';

if (isset($_POST['sub'])) {

    $Error = null;
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = $conn->prepare("SELECT * FROM `user` WHERE email = ? and password = ?");
    $result->bindValue(1, $email);
    $result->bindValue(2, $password);
    $result->execute();
    if ($result->rowCount() >= 1) {
        $rows = $result->fetch(PDO::FETCH_ASSOC);
        $_SESSION['login'] = true;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['role'] = $rows['role'];
        if (isset($_POST['rem'])) {
            setcookie("email", $_SESSION['email'], time() + 60 * 60 * 24 * 7, '/');
            setcookie("password", $_SESSION['password'], time() + 60 * 60 * 24 * 7, '/');
        } else {
            echo 0;
        }
        header("Location: ../");
    } else {
        $Error = true;
    }
}

?>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>weblog</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container">
        <br>

        <!-- start headers -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">وبلاگ</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">خانه <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">پروفایل</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            مقالات
                        </a>
                        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">برنامه نویسی</a>
                            <a class="dropdown-item" href="#">طراحی وب</a>
                            <a class="dropdown-item" href="#">بازی سازی</a>
                        </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0 mr-auto">
                    <input class="form-control mr-sm-2 placholder" type="search" placeholder="دنبال چی میگردی؟" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">جستجو</button>
                </form>
            </div>
        </nav>
    </div>
    <!-- end headers -->

    <br><br><br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-12 col-lg-4">
                <form method="POST" class="register-form">
                    <input name="email" type="email" placeholder="ایمیل">
                    <input name="password" type="password" placeholder="رمز عبور"><br>
                    <input name="rem" type="checkbox" class="rememberme">
                    <label class="remembermelabel">مرا به خاطر بسپار</label>
                    <input name="sub" type="submit" value="وارد شدن" class="btn btn-primary submit-register">
                    <a href="register.php" class="btn btn-primary submit-register">ثبت نام</a>
                </form>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>


    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <!-- footer my website -->

    <footer>
        <div class="footer1">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-7"><br><br><br>
                        <form>
                            <input type="text" class="input-group" placeholder="پست الکتریکی شما">
                            <input type="submit" class="btn btn-success" value="عضویت در خبرنامه">
                        </form>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="namad">
                            <img src="https://toplearn.com/site/images/star2.png" alt="">
                            <img src="https://toplearn.com/site/images/logo-samandehi.png" height="166px" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer2">
            <p class="container">تمام حقوق این وبسایت برای وبلاگ محفوظ است و هرگونه استفاده بدونه اجازه از ما پیگرد
                قانونی دارد</p>
        </div>
    </footer>


</body>

<?php $HttpReferer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null; ?>
<?php if ($Error) { ?>

    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'مقادیر غلط وارد شدند!',
            footer: '<a href="">Why do I have this issue?</a>'
        })
    </script>

<?php } elseif ($HttpReferer == "http://localhost/cms/page/register.php") { ?>

    <script>
        Swal.fire(
            'Good job!',
            'ثبت نام با موفقیت انجام شد.',
            'success'
        )
    </script>

<?php } ?>
<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</html>