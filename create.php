<?php
    include_once ("header.php");
    //Функция проверки всех полей формы регистрации
    function check_data($post) {
        $error = "";
        if (!$post["login"])
            $error = "Login can`t be empty";
        else if (!$post["pass"])
            $error = "Password can`t be empty";
        else if (!$post["email"])
            $error = "EMail can`t be empty";
        else if (!$post["date"])
            $error = "Birthday can`t be empty";
        return $error;
    }
    //Если пользователь нажал "Создать учетную запись". При первой загрузке страницы данный код исполняться не будет.
    if ($_POST["submit"] == "create") {
        //Проверяем наличие полей
        $error = check_data($_POST);
        //Поля все, ошибок нет.
        if ($error == "") {
            $login = $_POST["login"];
            //Считали логи с POST и ищем в базе есть ли такой логин
            $answer = mysqli_query($conn, "SELECT * FROM `users` WHERE `login`='$login'");
            if ($answer->num_rows != 0) {
                //Такой логин есть, ошибка
                $error = 'User with same login exists, so please, change it!';
            }
            else {
                //Логин чист можно создавать
                $pass = hash('whirlpool', $_POST["pass"]);
                $email = $_POST["email"];
                $date = $_POST["date"];
                $path = "img/" . $login;
                $file = $path . "/" . $_FILES["img"]["name"];
                //создаем папку img с вложеной папкой по логину пользователя
                mkdir($path, '0777', TRUE);
                //Перемещаем файл и tmp папки для загрузки файлов в нужную нам
                move_uploaded_file($_FILES["img"]["tmp_name"], $file);
                //Добавляем данные в базу
                $sql = "INSERT INTO `users`(`login`, `pass`, `email`, `date`, `img`) VALUES ('$login','$pass','$email','$date', '$file')";
                $answer = mysqli_query($conn, $sql);
                if (!$answer) {
                    //ответ от базы не пришел, ошибка
                    $error = 'Internal server error, please try later...';
                } else
                    //Учетка создана, можно перенаправлять на страницу логина.
                    header("Location: index.php");
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="css/index.css">
    <script src="script/index.js"></script>
</head>
<body>
<!-- при наличии ошибки, выведем JS-скрипт с сообщением об этой ошибке -->
<?php if ($error != "") echo "<script> alert(\"$error\");</script>"; ?>
<div class="login-page">
    <div class="form">
        <form class="register-form" method="post" onsubmit="return check_values()" enctype='multipart/form-data'>
            <input type="text" id="login" name="login" placeholder="login"/>
            <input type="password" id="pass" name="pass" placeholder="password"/>
            <input type="email" id="email" name="email" placeholder="email address"/>
            <input type="date" id="date" name="date">
            <input type="file" id="file" name="img" accept=".jpg, .gif, .png">
            <input class="button" type="submit" name="submit" value="create">
            <p class="message">Already registered? <a href="index.php">Sign In</a></p>
        </form>
    </div>
</div>
</body>
</html>