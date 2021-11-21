<?php
include_once('functions.php');
function set_main_values()
{
    $a = ['content_url' => $_POST['сontent_url'], 
    'content_text' => $_POST['content_text'],
    'content_text2' => $_POST['content_text2']];
    return $a;
}
function set_id()
{
    $a = set_main_values();
    $a += ['id' => $_POST['id']];
    return $a;
}
function Upload($dbh, $table, $data)
{
    $sth = $dbh->prepare("INSERT INTO `$table` (content_url, content_text, content_text2) VALUES (:content_url,:content_text, :content_text2)");
    $sth->execute($data);
}
function Update($dbh, $table, $data)
{
    $sth = $dbh->prepare("UPDATE `$table` SET content_url=:content_url, content_text=:content_text, content_text2=:content_text2 WHERE id=:id");
    $sth->execute($data);
}
function Delete($dbh, $table)
{
    $sth = $dbh->prepare("DELETE FROM `$table` WHERE id=:id");
    $sth->execute(['id' => $_POST['id']]);
}

if (isset($_POST['add'])) {
    $dbh = ConnectToDataBase();
    $a = set_main_values();
    Upload($dbh, 'main', $a);
    header('Location: admin.php');
}

if (isset($_POST['edit'])) {
    $dbh = ConnectToDataBase();
    $a = set_id();
    Update($dbh, 'main', $a);
    header('Location: admin.php');
}
if (isset($_POST['delete'])) {
    $dbh = ConnectToDataBase();
    Delete($dbh, 'main');
    header('Location: admin.php');
}
