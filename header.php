<?php
    //запускаем сессию, нужна для логина пользователя
    session_start();

    //Описание полей подключения базы данных
    define("SQL_HOST", 'localhost');
    define("SQL_LOGIN", 'root');
    define("SQL_PASS", 'root');
    define("SQL_PORT", '8889');
    define("SQL_DB", 'tz');

    //подключаем базу данных
    $conn = mysqli_connect(SQL_HOST, SQL_LOGIN, SQL_PASS, SQL_DB, SQL_PORT);
