<?php

function set_values(){
    $data = [
    "name" => $_POST['name'],
    "email" => $_POST['email'],
    "message" => $_POST['message']];
    return $data;
}
function echo_text($sentences){
foreach($sentences as $sentence)
{
    echo $sentence.".<br/>";
}
}
if (isset($_POST)) {
    $data = set_values($_POST);
    $text = $data["message"];
    echo $text."<br><br>";
    $text = preg_replace('#\s+#u',' ',$text);
    $text = preg_replace('#(\d)#', '<span style="color:blue">$1</span>', $text);
    $text = preg_replace('#(\b[А-ЯЁA-Z]{2,}\b)#u', '<span style="text-decoration: underline">$1</span>', $text);

    $sentences = preg_split("#[.]+#",$text,-1,PREG_SPLIT_NO_EMPTY);
    echo_text($sentences);
};
//header("Location: contact.php");