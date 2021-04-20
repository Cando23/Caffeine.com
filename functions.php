<?php

function GetContent($content_array,$i, $url):string
{
    $content_text_template = file_get_contents($url);
    $content_text_template = str_replace("{content_url}",$content_array[$i]["сontent_url"], $content_text_template);
    $content_text_template = str_replace("{content_text}",$content_array[$i]["content_text"],  $content_text_template);
    $content_text_template = str_replace("{content_text2}",$content_array[$i]["content_text2"], $content_text_template);
    return $content_text_template;
}

function ConnectToDataBase()
{
    try {
        $dbh = new PDO('mysql:dbname=coffe_site;host=localhost', 'root', '',
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    return $dbh;
}

function DownloadContent($table){
    $dbh = ConnectToDataBase();
    $sth = $dbh->prepare("SELECT * FROM `$table`");
    $sth->execute();
    $content_array = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $content_array;
}

function DownloadFieldContent($table, $page)
{
    $dbh = ConnectToDataBase();
    $sth = $dbh->prepare("SELECT * FROM `$table` WHERE `page` = ?");
    $sth->execute(array($page));
    $field_array = $sth->fetch(PDO::FETCH_ASSOC);
    return $field_array;
}

function UploadFieldContent($table, $data)
{
$dbh = ConnectToDataBase();
$sth = $dbh->prepare("INSERT INTO `$table` (name, email, review) VALUES (:name, :email, :review)");
$sth->execute($data);
}