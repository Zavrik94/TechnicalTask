<?php
    include_once ("header.php");
    if ($_POST["submit"] == "logout") {
        $_SESSION["login"] = "";
        header("Location: index.php");
    } else {
        $login = $_SESSION["login"];
        $answer = mysqli_query($conn, "SELECT * FROM `users` WHERE `login`='$login'");
        if ($answer->num_rows != 0) {
            $res = mysqli_fetch_assoc($answer);
            $email = $res["email"];
            $date = $res["date"];
            $img = $res["img"];
        } else {
            $error = "Can`t load you profile. Try again.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>

<div class="login-page">
    <img class="profile-image" src="<?= $img ?>">
    <div class="form">
        <form class="register-form" method="post">
            <text id="login"><?= $login ?></text><br><br>
            <text id="email"><?= $email ?></text><br><br>
            <text id="date"><?= $date ?></text><br><br>
            <input class="button" type="submit" name="submit" value="logout">
        </form>
    </div>
</div>

</body>

</html>
