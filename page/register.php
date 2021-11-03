<?php require_once '../database/db.php';

if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['age']) && !empty($_POST['password'])) {

    // $_SERVER['HTTP_REFERER'] = "http://localhost/cms/page/login.php";
    // $HttpReferer = "http://localhost/cms/page/register.php";
    $Error = "";
    $successmassege = null;
    if (isset($_POST['sub'])) {
        $name = $_POST['username'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $password = $_POST['password'];

        // $arr = false;
        $query = "SELECT * FROM `user` WHERE email = ?";
        $stmt = $conn->prepare($query);
        $check = $stmt->execute([$email]);
        if ($check) {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (is_array($data) && count($data) > 0) {
                $Error = true;
            } else {
                $result = $conn->prepare("INSERT INTO `user` SET `username` = ?, `email` = ?, `age` = ?, `password` = ?");
                $result->bindValue(1, $name);
                $result->bindValue(2, $email);
                $result->bindValue(3, $age);
                $result->bindValue(4, $password);
                $result->execute();
                // $HttpReferer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
                $successmassege = true;
                header("Location: login.php");
            }
        }
    }
}

?>


<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>weblog</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
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
                    <input name="username" type="text" placeholder="نام کاربری">
                    <input name="email" type="email" placeholder="ایمیل">
                    <input name="age" type="number" placeholder="سن">
                    <input name="password" type="password" placeholder="رمز عبور"><br>
                    <input name="sub" type="submit" value="ثبت نام" class="btn btn-primary submit-register">
                    <!-- <a href="login.php" class="btn btn-primary submit-register">وارد شدن</a> -->
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
<?php if ($successmassege) { ?>

    <script>
        Swal.fire(
            'Good job!',
            'ثبت نام با موفقیت انجام شد.',
            'success'
        )
    </script>
<?php } elseif ($Error) { ?>

    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            title: ' این ایمیل قبلا توسط کسی دیگر ثبت شده است',
            footer: '<a href="">Why do I have this issue?</a>'
        })
    </script>
<?php } ?>
<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</html>