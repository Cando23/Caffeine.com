<?php
include_once('functions.php');
session_start();

$dbh = ConnectToDataBase();
$data = DownloadFieldContent($dbh, 'users', 'login', $_POST['login']);
if ($data) {
    if ($data['password'] === md5(md5($_POST['password']))) {
        $_SESSION['user'] = [
            "id" => $data["id"],
            "login" => $data["login"]
        ];
        if ($data['login'] === 'admin')
            header('Location: admin.php');
        else
            header('Location: index.php');
    } else {
        $_SESSION['status'] = 'Неверный пароль!';
        header('Location: authorization.php');
    }
} else {
    $_SESSION['status'] = 'Данный пользователь не зарегистрирован!';
    header('Location: authorization.php');
}
