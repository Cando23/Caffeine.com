<?php
include_once('functions.php');
function Upload($dbh, $table, $data)
{
    $sth = $dbh->prepare("DELETE FROM `$table` WHERE id=:id");
    $sth->execute($data);
}
$dbh = ConnectToDataBase();
$a = ['id' => '11'];
Upload($dbh, 'main', $a);
//$sth = $dbh->prepare("UPDATE $table SET content_url=:content_url, content_text = :content_text, content_text2 = :content_text2 WHERE id=:id ");