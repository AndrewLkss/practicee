<?php 
    require "db.php";

    $data = $_POST;
    if( isset($data['do_signup']) )
    {

    
        $errors = array();
        if( trim($data['login']) == '' )
        {
            $errors[] = 'Enter login';
        }

        if( trim($data['email']) == '' )
        {
            $errors[] = 'Enter email';
        }

        if( ($data['password']) == '' )
        {
            $errors[] = 'Enter password';
        }

        if( ($data['password_2']) !=$data['password'] )
        {
            $errors[] = 'repeated pass is wrong';
        }

        if( R::count('users', "login = ?", array($data['login'])) > 0 )
        {
            $errors[] = 'Login already in use';
        }

        if( R::count('users', "email = ?", array($data['email'])) > 0 )
        {
            $errors[] = 'email already in use';
        }

        if( empty($errors) )
        {
            //reg
            $user = R::dispense('users');
            $user->login = $data['login'];
            $user->email = $data['email'];
            $user->rights = "0";
            $user->blocked = "0";
            $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
            R::store($user);
            header('Location: ./login.php');
            echo '<div style="color: green;">Registered succesfuly</div><hr>';
        } else
        {
            echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
        }


    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>market</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,600,800">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400i,700,700i">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets/css/--mp---Multiple-items-slider-responsive.css">
    <link rel="stylesheet" href="assets/css/--mp---Testimonials-Slider.css">
    <link rel="stylesheet" href="assets/css/-.css">
    <link rel="stylesheet" href="assets/css/component-1.css">
    <link rel="stylesheet" href="assets/css/component-2.css">
    <link rel="stylesheet" href="assets/css/component-3.css">
    <link rel="stylesheet" href="assets/css/component.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
    <link rel="stylesheet" href="assets/css/nav-with-cart-blue.css">
    <link rel="stylesheet" href="assets/css/Navigation-Menu.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/Shop-item-1.css">
    <link rel="stylesheet" href="assets/css/Shop-item.css">
    <link rel="stylesheet" href="assets/css/Simple-Slider.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Ultimate-Testimonial-Slider.css">
    <link rel="stylesheet" href="assets/css/yyuiyuiyiu.css">
</head>

<body style="background-color: #f6f8fa;">
    <div style="width: 100%;height: 50px;background-color: rgba(51, 51, 51, 1);">
        <p style="color: rgb(34,120,248);font-weight: bold;font-size: 20px;text-align: center;padding-top: 10px;">СКИДКИ ДО 20%</p>
    </div>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-search">
        <div class="container"><a class="navbar-brand" href="index.html">keystore</a><a href="search.html"><button class="btn btn-primary" type="button">Каталог</button></a>
            <div class="row padMar">
                <div class="col padMar">
                    <div class="input-group">
                        <div class="input-group-prepend"></div><input class="form-control autocomplete" type="text" placeholder="Что ищем сегодня?" style="width: 300px;margin-right: 50;border-radius: 5px;">
                        <div class="input-group-append"><button class="btn btn-warning" type="button" style="margin-right: 60px;margin-left: 10px;border-color: rgb(21,112,248);/*box-shadow: 0 0 0 .2rem rgba(26,91,188,0.49);*/"><i class="fa fa-search" style="/*margin-right: 20px;*/"></i><a href="search.html"></a></button></div>
                    </div>
                </div>
            </div><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"></li>
                    <li class="nav-item" role="presentation"></li>
                    <li class="nav-item" role="presentation"></li>
                </ul><a href="login.php"><button class="btn btn-primary" type="button">Авторизация</button></a><a href="register.php"><button class="btn btn-primary" type="button">Регистрация</button></a><a href="#"><img src="assets/img/mdi_shopping_cart.png"></a></div>
        </div>
    </nav>
    <div class="register-photo">
        <div class="form-container">
            <form action="./register.php" method="POST">
                <h2 class="text-center"><strong>Регистрация</strong></h2>
                <div style="margin-left: auto;margin-right: auto;width: 300px;">
                    
                    <div class="form-group"><input minlength="8" maxlength="20" class="form-control" type="text" name="login" placeholder="Ваше имя" value="<?php echo @$data['login']; ?>"></div>
                    <div class="form-group"><input  class="form-control" type="email" name="email" placeholder="Email" value="<?php echo @$data['email']; ?>"></div>
                    <div class="form-group"><input minlength="8" maxlength="20" class="form-control" type="password" name="password" placeholder="Пароль" value="<?php echo @$data['password']; ?>"></div>
                    <div class="form-group"><input class="form-control" type="password" name="password_2" placeholder="Повторите пароль" value="<?php echo @$data['password_2']; ?>"></div>
                    <div class="form-group">
                        <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox">Даю согласие на обработку персональных данных.</label></div>
                    </div>
                    <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="do_signup" style="background-color: rgb(21,112,248);color: white;">Sign Up</button></div><a class="already" href="login.html">Уже есть аккаунт?</a></div>
            </form>
        </div>
    </div>
    <div style="width: 100%;height: 260px;background-color: rgba(51, 51, 51, 1);display: flex;margin-top: 150px;">
        <div style="width: 30%;">
            <p style="color: white;font-size: 40px;font-weight: bolder;margin-left: 60px;padding-top: 30px;">keystore</p>
            <p style="color: rgb(201,201,201);padding-left: 60px;">2020 ООО "ДРОНСТАЙЛ"</p><a href="#" style="color: white;padding-left: 60px;">Пользовательское соглашение</a></div>
        <div style="width: 80%;">
            <p style="color: white;font-size: 30px;font-weight: bold;padding-top: 42px;">Помощь</p>
            <a href="#" style="color: white;">
                <p>Контакты</p>
            </a>
            <a href="#" style="color: white;">
                <p>FAQ</p>
            </a>
            <a href="#" style="color: white;">
                <p>О нас</p>
            </a>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/--mp---Multiple-items-slider-responsive-1.js"></script>
    <script src="assets/js/--mp---Multiple-items-slider-responsive.js"></script>
    <script src="assets/js/--mp---Testimonials-Slider.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>
    <script src="https://use.fontawesome.com/1744f3f671.js"></script>
    <script src="assets/js/Simple-Slider.js"></script>
</body>

</html>