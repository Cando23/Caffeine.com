<?php
session_start();
include_once('functions.php');
function FillTemplate($content_array, $url)
{
    $data = '';
    $max = sizeof($content_array);
    for ($i = 0; $i < $max; $i++) {
        $data .= GetContentWithId($content_array, $i, $url);
    }
    return $data;
}
//если пользователь не авторизован
if (isset($_SESSION['user']) && $_SESSION['user']['login'] === 'admin') {
    $dbh = ConnectToDataBase();
    $field_array = DownloadFieldContent($dbh, 'auxiliary', 'page', 'index');
    $template = file_get_contents("templates/admin.html");
    $header = file_get_contents("templates/header.html");
    $header = ChangeSignLink($header);
    $header = CheckAdmin($header);
    $template = str_replace('{header}', $header, $template);
    $footer = file_get_contents("templates/footer.html");
    $footer = str_replace('{footer_content}', $field_array['footer'], $footer);
    $content_array = DownloadContent($dbh, 'main');
    $db_lines = FillTemplate($content_array, "templates/db_line.html");
    $edit = FillTemplate($content_array, "templates/admin_edit.html");
    $delete = FillTemplate($content_array, "templates/admin_delete.html");
    $template = str_replace('{edit}', $edit, $template);
    $template = str_replace('{delete}', $delete, $template);
    $template = str_replace('{db_lines}', $db_lines, $template);
    $template = str_replace('{footer}', $footer, $template);
    echo $template;
} else
    header("Location: /webtech/admin");
