//Функция проверки всех полей регистрационной формы
function check_values() {
    var login = document.getElementById("login");
    var pass = document.getElementById("pass");
    var file = document.getElementById("file");
    if (!check_login(login.value)) {
        alert("Login may contain only English alphabet and numbers and be at least 4 characters");
        return false;
    }
    if (!check_pass(pass.value)) {
        alert("Password has wrong numbers and may at least 8 characters");
        return false;
    }
    if (!check_file(file.value)) {
        alert("Wrong type of file");
        return false;
    }
}

//Проверка логина
function check_login(text) {
    var symb = /^[a-zA-Z0-9]*$/;
    if (text.length < 4)
        return (false);
    return (text.match(symb));
}
//Проверка пароля
function check_pass(text) {
    var symb = /^[a-zA-Z0-9-!_\-]*$/;
    if (text.length < 8)
        return (false);
    return (text.match(symb));
}
//Проверка расширения файла
function check_file(name) {
    var res = name.substr(name.length - 3, name.length);
    var passed = ["jpg", "gif", "png"];
    return (passed.includes(res));
}