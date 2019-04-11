<?php
    include_once ("header.php");
    //Если нажата кнопка логин, иначе не исполнять скрипт
    if ($_POST["submit"] == "login") {
        $login = $_POST["login"];
        $pass = hash('whirlpool', $_POST["pass"]);
        //Поиск записи в базе с нужным нам логином
        $answer = mysqli_query($conn, "SELECT * FROM `users` WHERE `login`='$login'");
        if ($answer->num_rows != 0) {
            //Такой логин есть будем проверять хэш пароля
            $res = mysqli_fetch_assoc($answer);
            if ($res["pass"] == $pass) {
                //Пароли совпадают, запишем в сессию логин, и перенаправим на страницу профиля
                $_SESSION["login"] = $login;
                header("Location: profile.php");
            } else {
                //Хэш паролей не совпадают
                $error = "Wrong password";
            }
        } else {
            //Логин пользователя в базе не найден
            $error = "Account does not exist";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
<!-- при наличии ошибки, выведем JS-скрипт с сообщением об этой ошибке -->
<?php if ($error != "") echo "<script> alert(\"$error\");</script>"; ?>

<div class="login-page">
    <div class="form">
        <form class="login-form" method="post">
            <input type="text" id="login" name="login" placeholder="login"/>
            <input type="password" id="pass" name="pass" placeholder="password"/>
            <input class="button" type="submit" name="submit" value="login">
            <p class="message">Not registered? <a href="create.php">Create an account</a></p>
        </form>
    </div>
</div>
</body>

</html>
