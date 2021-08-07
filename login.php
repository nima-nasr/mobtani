<?php
include "../database/db.php";
$successmassage = null;
$errormassage = null;
if(isset($_POST['sub'])){
    global $conn;
    $email  = $_POST['email'];
    $password  = $_POST['password'];
    $gt = $conn->prepare("SELECT * FROM users WHERE email=? AND password=?");
    $gt->bindValue(1,$email);
    $gt->bindValue(2,$password);
    $gt->execute();
    if($gt->rowCount()>=1){
        $rows = $gt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['login'] = true;
        $_SESSION['id'] = $rows['id'];
        $_SESSION['username'] = $rows['username'];
        $_SESSION['email'] = $rows['email'];
        $_SESSION['phone'] = $rows['phone'];
        $_SESSION['password'] = $rows['password'];
        $_SESSION['role'] = $rows['role'];
        $_SESSION['status'] = $rows['status'];
        $successmassage = true;
        header("location:../index.php?success=true");
    }else{
        $errormassage = true;
    }

}

//select menus
$gt = $conn->prepare("SELECT * FROM menu ORDER BY sort ASC");
$gt->execute();
$menus = $gt->fetchAll(PDO::FETCH_ASSOC);

?>

<html lang="fa">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ورود _ نیماشاپ</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<!-- top header -->
<div class="container top-header">
    <img src="../image/logo.png" alt="logo header" width="80px">
    <div class="search-box d-none d-lg-flex">
        <div class="input-group md-form form-sm form-1 pl-0">
            <input class="form-control my-0 py-1" type="text" style="font-size: 14px;"
                   placeholder="دنبال چه محصولی میگردی؟" aria-label="Search">
            <div class="input-group-prepend">
                    <span style="background-color: #007bff;" class="input-group-text purple lighten-3"
                          id="basic-text1"><svg style="color: #fff;" width="1em" height="1em" viewBox="0 0 16 16"
                                                class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
                            <path fill-rule="evenodd"
                                  d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
                        </svg></span>
            </div>
        </div>
    </div>
    <div class="instagram-icon">
        <nav class="navbar navbar-expand-lg" style="width: 100%; direction: ltr;">
            <div style="margin-left: -16px; margin-right: -22px;">
                <div class="container">
                    <ul class="navbar-nav">
                        <?php if (isset($_SESSION['login'])) {?>
                            <li class="nav-item dropdown">
                                <a style="color:#333; padding-left: 35px; margin-top: -50px;" class="nav-link" href="#"
                                   role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                   style="color: #fff">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                    </svg>
                                    <?php echo $_SESSION['username']?>
                                    <img src="../image/avatar-2.jpg"
                                         style="margin-top: -13px; border-radius: 50%; border: 2px solid #ccc;"
                                         width="50px" alt="">
                                </a>
                                <div class="dropdown-menu myaccont-dropdown dropdown-menu-right text-right"
                                     aria-labelledby="navbarDropdown" style="margin-right: -40px;"><br>
                                    <a class="dropmenu" href="showusers.php" style="margin-top: -20px;">
                                        <svg style="color: #6fc341; margin-left: 2px;" width="0.4em" height="0.4em"
                                             viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="8" cy="8" r="8" />
                                        </svg>
                                        مشاهده ی حساب کاربری</a>
                                    <a class="dropmenu" href="#">
                                        <svg style="color: #6fc341; margin-left: 2px;" width="0.4em" height="0.4em"
                                             viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="8" cy="8" r="8" />
                                        </svg>
                                        <?php if($_SESSION['role'] == 1){echo 'کاربر عادی';}else{echo 'ادمین';}  ?></a>
                                    <?php ?>
                                    <?php if($_SESSION['role'] == 1){ ?>
                                    <a class="dropmenu" href="userproduct.php">
                                        <svg style="color: #6fc341; margin-left: 2px;" width="0.4em" height="0.4em"
                                             viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="8" cy="8" r="8" />
                                        </svg>
                                        <?php echo 'اضافه کردن محصول کاربر';} ?></a>
                                    <a class="dropmenu" href="shop.php">
                                        <svg style="color: #6fc341; margin-left: 2px;" width="0.4em" height="0.4em"
                                             viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="8" cy="8" r="8" />
                                        </svg>
                                        سبدخرید</a>
                                    <a class="dropmenu" href="logout.php">
                                        <svg style="color: #6fc341; margin-left: 2px;" width="0.4em" height="0.4em"
                                             viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="8" cy="8" r="8" />
                                        </svg>
                                        خروج</a>
                                    <a class="dropmenu" href="#">
                                        <svg style="color: #6fc341; margin-left: 2px;" width="0.4em" height="0.4em"
                                             viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="8" cy="8" r="8" />
                                        </svg>
                                        <?php if($_SESSION['status'] == 1){ ?>فعال<?php }else{ ?>غیرفعال<?php } ?></a>


                                    <?php if ($_SESSION['role'] == 2){ ?>
                                        <a class="dropmenu" href="../admin">
                                            <svg style="color: #6fc341; margin-left: 2px;" width="0.4em" height="0.4em"
                                                 viewBox="0 0 16 16" class="bi bi-circle-fill" fill="currentColor"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="8" cy="8" r="8" />
                                            </svg>
                                            مشاهده پنل ادمین</a>
                                    <?php } ?>

                                </div>
                            </li>
                        <?php }else{ ?>
                            <li>
                                <a href="login.php">ورود</a>
                                <a href="register.php">ثبت نام</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- nav menu -->

<nav class="navbar navbar-expand-lg navbar-light" id="nav-menu" style="width: 100%; ">
    <button style="margin-bottom: 10px;" class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent"
         style="background: linear-gradient(145deg,#aa4806 20%,#5a009a 80%); margin-left: -16px; margin-right: -22px;">
        <div class="container">
            <ul class="navbar-nav">
                <?php foreach ($menus as $menu){ if($menu ['z']==0 ){?>
                    <li class="nav-item dropdown">
                        <a href="<?php echo $menu['src']?>" class="nav-link <?php foreach ($menus as $z){if ($menu['id'] == $z['z']){ ?> dropdown-toggle <?php }} ?>" id="navbarDropdown" role="button"
                           <?php foreach ($menus as $z){if ($menu['id'] == $z['z']){ ?>data-toggle="dropdown"<?php }} ?> aria-haspopup="true" aria-expanded="false" style="color: #fff;">
                            <?php echo $menu['title'] ?>
                        </a>
                        <div style="background: linear-gradient(90deg,#06aa8a 20%,#00619a 80%);" class="dropdown-menu dropdown-menu-right text-right" aria-labelledby="navbarDropdown">
                            <?php foreach ($menus as $ul){if($menu['id']==$ul['z']){ ?>
                                <a class="dropmenu" href="<?php echo $ul['src']?>"> <?php echo $ul['title'];?> </a>

                            <?php }} ?>

                        </div>
                    </li>
                <?php }}?>
            </ul>
        </div>
    </div>
</nav>
    <br>


    <div class="container">
        <div class="row">
            <div class="register-item" style="height: 700px;">
                <div class="header-register">
                    <h4>ورود به سایت</h4>
                    <p>با ورود در سایت ، از مزایای کاربران سایت بهره مند شوید</p>
                    <img src="../image/login.png" width="320px" style="margin-right: 180px;"
                        alt="">
                </div>

                <div class="input-register">
                    <form method="post">
                        <input name="email" type="email" style="display: block; " placeholder="ایمیل را وارد کنید">
                        <input name="password" type="password" style="display: block; " placeholder="رمز عبور را وارد کنید">
                        <input name="sub" type="submit" value="ورود" class="btn btn-info" >
                    </form>

                </div>

                <div class="footer-register">

                    <a href="register.php" class="btn-reg">ثبت نام در سایت</a>


                </div>

            </div>
        </div>
    </div>



    <br><br>
<footer>
    <div class="footer-back">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4"><br>
                    <h6>درباره نیماشاپ</h6>
                    <hr class="header-caption-footer">
                    <p class="caption-footer">یک سایت اموزشی نسبتا کامل که تاحدودی سعی شده رسپانسیو باشد، بزودی درگاه خرید هم راه اندازی میشود و امکان خرید اضافه میگردد</p>
                </div>
                <div class="col-12 col-lg-1"></div>
                <div class="col-12 col-lg-2"><br>
                    <h6>بخش های سایت</h6>
                    <hr class="header-caption-footer">
                    <a style="color: #fff; display:block;margin-top: 10px;"  href="../index.php">خانه</a>
                    <a style="color: #fff; display:block;margin-top: 10px;"  href="../pages/aboutme.php">درباره ما</a>
                    <a style="color: #fff; display:block;margin-top: 10px;"  href="contactus.php">تماس با ما</a>
                    <a style="color: #fff; display:block;margin-top: 10px;"  href="https://www.instagram.com/nima700h/">اینستاگرام</a>
                </div>
                <div class=" col-12 col-lg-1">
                </div>
                <div class="col-12 col-lg-3"><br>
                    <h6>راه های ارتباطی</h6>
                    <hr class="header-caption-footer">
                    <p class="caption-footer">با ما تماس بگیرید.
                    </p>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-open" viewBox="0 0 16 16">
                            <path d="M8.47 1.318a1 1 0 0 0-.94 0l-6 3.2A1 1 0 0 0 1 5.4v.818l5.724 3.465L8 8.917l1.276.766L15 6.218V5.4a1 1 0 0 0-.53-.882l-6-3.2zM15 7.388l-4.754 2.877L15 13.117v-5.73zm-.035 6.874L8 10.083l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738zM1 13.117l4.754-2.852L1 7.387v5.73zM7.059.435a2 2 0 0 1 1.882 0l6 3.2A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765l6-3.2z"/>
                        </svg>
                        <span>
                                    ایمیل : nimashop937@gmail.com
                                </span>
                    </div>

                    <div style="margin-top: 10px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-outbound-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zM11 .5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-4.146 4.147a.5.5 0 0 1-.708-.708L14.293 1H11.5a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                        <span> تماس: 09376822035</span>
                    </div><br>
                </div>
            </div>
            <br class="d-none d-lg-flex">
        </div>
    </div>
</footer>
<footer class="footer2">
    <div class="container">
        <p>کليه حقوق محصولات و محتوای اين سایت متعلق به نیماشاپ می باشد و هر گونه کپی برداری از محتوا و محصولات سایت
            غیر
            مجاز و بدون رضایت ماست</p>
    </div>
</footer>

<img src="../image/teleg2.png" alt="" class="fixed-bottom d-none d-lg-block">
</body>
<script src="../js/jquery-3.5.1.min.js"></script>
<script src="../js/javascript.js"></script>
<script src="../js/bootstrap.min.js"></script>

<?php if($successmassage){ ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: 'با موفقیت وارد شدید'
        })
    </script>
<?php } ?>

<?php if($errormassage){ ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'error',
            title: 'ایمیل یا رمز عبور اشتباه است'
        })
    </script>
<?php } ?>


</html>


