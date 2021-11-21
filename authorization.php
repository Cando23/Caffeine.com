<?php
//DATA
session_start();
include_once('functions.php');
$dbh = ConnectToDataBase();
$field_array = DownloadFieldContent($dbh, 'auxiliary', 'page', 'authorization');

$header = file_get_contents("templates/header.html");
$footer = file_get_contents("templates/footer.html");
$authorization_content = file_get_contents("templates/authorization_content.html");
$template = file_get_contents("templates/authorization.html");

//TEMPLATING
$header = CloseSession($header);
$authorization_content = str_replace('{content_caption}', $field_array['content_caption'], $authorization_content);
$authorization_content = str_replace('{other_content}', $field_array['other_content'], $authorization_content);
$template = str_replace('{title}', $field_array['title'], $template);
$template = str_replace('{header}', $header, $template);
$authorization_content = GetRegisterStatus($authorization_content);
$template = str_replace('{authorization_content}', $authorization_content, $template);
$footer = str_replace('{footer_content}', $field_array['footer'], $footer);
$template = str_replace('{footer}', $footer, $template);

print $template;
