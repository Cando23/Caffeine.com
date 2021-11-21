<?php
function GetContentWithId($content_array, $i, $url): string
{
    $content_text_template = GetContent($content_array, $i, $url);
    $content_text_template = str_replace("{id}", $content_array[$i]["id"], $content_text_template);
    return $content_text_template;
}
function GetContent($content_array, $i, $url): string
{
    $content_text_template = file_get_contents($url);
    $content_text_template = str_replace("{content_url}", $content_array[$i]["content_url"], $content_text_template);
    $content_text_template = str_replace("{content_text}", $content_array[$i]["content_text"],  $content_text_template);
    $content_text_template = str_replace("{content_text2}", $content_array[$i]["content_text2"], $content_text_template);
    return $content_text_template;
}

function ConnectToDataBase()
{
    try {
        $dbh = new PDO(
            'mysql:dbname=coffe_site;host=localhost',
            'root',
            '',
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
        );
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $dbh;
}

function DownloadContent($dbh, $table)
{
    $sth = $dbh->prepare("SELECT * FROM `$table`");
    $sth->execute();
    $content_array = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $content_array;
}

function DownloadFieldContent($dbh, $table, $field, $value)
{
    $sth = $dbh->prepare("SELECT * FROM `$table` WHERE `$field` = ?");
    $sth->execute(array($value));
    $field_array = $sth->fetch(PDO::FETCH_ASSOC);
    return $field_array;
}

function UploadFieldMail($dbh, $table, $data)
{
    $sth = $dbh->prepare("INSERT INTO `$table` (name, email, review) VALUES (:name, :email, :review)");
    $sth->execute($data);
}

function Registеr($dbh, $table, $data)
{
    $sth = $dbh->prepare("INSERT INTO `$table` (login, password) VALUES (:login, :password)");
    $sth->execute($data);
}

function ChangeSignLink($header)
{
    if (isset($_SESSION['user']))
        $header = str_replace('{action}', "Выйти", $header);
    else
        $header = str_replace('{action}', "Войти", $header);
    return $header;
}

function CloseSession($header)
{
    if (isset($_SESSION['user'])) {
        session_destroy();
    }
    $header = str_replace('{action}', "Войти", $header);
    $header = str_replace('{admin}', "", $header);
    return $header;
}

function CheckAdmin($header)
{
    if (isset($_SESSION['user'])) {
        if ($_SESSION['user']['login'] === 'admin')
            $header = str_replace('{admin}', '<li><a href="admin.php">Админка</a></li>', $header);
        else
            $header = str_replace('{admin}', "", $header);
    } else
        $header = str_replace('{admin}', "", $header);
    return $header;
}

function GetRegisterStatus($content)
{
    if (isset($_SESSION['status']))
    {
        $status = file_get_contents("templates/status.html");
        $status = str_replace('{data}', $_SESSION['status'], $status);
        $content = str_replace('{status}', $status, $content); 
        unset($_SESSION['status']);
    }
    else
    $content = str_replace('{status}', "", $content);
    return $content;
}