<?php
include_once("functions.php");
session_start();
function set_values($password)
{
    $data = [
        "login" => $_POST['login'],
        "password" => $password
    ];
    return $data;
}
if (isset($_POST)) {
    $dbh = ConnectToDataBase();
    if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['login'])) {
        $_SESSION['status'] =  "Логин должен содержать буквы английского алфавита!";
        header('Location: registration.php');
    } else
    if (strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30) {
        $_SESSION['status'] =  "Логин должен быть не меньше 3-х символов!";
        header('Location: registration.php');
    } else
    if ($_POST['password'] === $_POST['password_confirm']) {
        $query = DownloadFieldContent($dbh, 'users', 'login', $_POST['login']);
        if ($query) {
            $_SESSION['status'] = 'Пользователь с таким логином уже существует!';
            header('Location: registration.php');
        } else {
            $password = md5(md5($_POST['password']));
            $data = set_values($password);
            Registеr($dbh, 'users', $data);
            $_SESSION['status'] = 'Регистрация прошла успешно!';
            header('Location: registration.php');
        }
    } else {
        $_SESSION['status'] = 'Пароли не совпадают!';
        header('Location: registration.php');
    }
}
