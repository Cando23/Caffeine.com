<?php
//DATA
session_start();
include_once('functions.php');
$dbh = ConnectToDataBase();
$field_array = DownloadFieldContent($dbh, 'auxiliary', 'page', 'contact');

$header = file_get_contents("templates/header.html");
$footer = file_get_contents("templates/footer.html");
$contact_content = file_get_contents("templates/contact_content.html");
$template = file_get_contents("templates/contact.html");

//TEMPLATING
$header = ChangeSignLink($header);
$header = CheckAdmin($header);
$contact_content = str_replace('{content_caption}', $field_array['content_caption'], $contact_content);
$contact_content = str_replace('{other_content}', $field_array['other_content'], $contact_content);
$template = str_replace('{title}', $field_array['title'], $template);
$template = str_replace('{header}', $header, $template);
$template = str_replace('{contact_content}', $contact_content, $template);
$footer = str_replace('{footer_content}', $field_array['footer'], $footer);
$template = str_replace('{footer}', $footer, $template);
print $template;
