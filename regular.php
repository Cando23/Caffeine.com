<?php
if (isset($_POST)) {
    $text = "я ста123ну 233 333 3333 22кру243тым пр23423огрASDаммистом  ASD п SADDA ADSDSAосле БГУИРа";
    $text = preg_replace('#(\d)|([A-Z])#', '<span style="color:blue">$2</span>', $text);
    echo $text;
    $sentences = preg_split("/ /",$text,-1,PREG_SPLIT_NO_EMPTY);
    $res = "";
    foreach($sentences as $item)
    {
        if (mb_strlen($item) >= 7){
           $item = mb_substr($item, 0, 6);
           $item .= "*";
        }
            $res .=" ";
            $res .= $item;
    }
    echo "<br>";
    echo $res;
}