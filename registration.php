<?php
//DATA
session_start();
include_once('functions.php');
$dbh = ConnectToDataBase();
$field_array = DownloadFieldContent($dbh, 'auxiliary', 'page', 'registration');

$header = file_get_contents("templates/header.html");
$footer = file_get_contents("templates/footer.html");
$registration_content = file_get_contents("templates/registration_content.html");
$template = file_get_contents("templates/registration.html");

//TEMPLATING
$header = ChangeSignLink($header);
$header = CheckAdmin($header);
$registration_content = str_replace('{content_caption}', $field_array['content_caption'], $registration_content);
$registration_content = str_replace('{other_content}', $field_array['other_content'], $registration_content);
$template = str_replace('{title}', $field_array['title'], $template);
$template = str_replace('{header}', $header, $template);
$registration_content = GetRegisterStatus($registration_content);
$template = str_replace('{registration_content}', $registration_content, $template);
$footer = str_replace('{footer_content}', $field_array['footer'], $footer);
$template = str_replace('{footer}', $footer, $template);

print $template;
