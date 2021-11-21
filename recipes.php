<?php
//DATA
session_start();
include_once('functions.php');
$dbh = ConnectToDataBase();
$content_array = DownloadContent($dbh, 'recipes');
$field_array = DownloadFieldContent($dbh, 'auxiliary', 'page', 'recipes');

$header = file_get_contents("templates/header.html");
$footer = file_get_contents("templates/footer.html");
$template = file_get_contents("templates/recipes.html");
$content_template = file_get_contents("templates/recipes_content.html");

//FUNCTIONS
function FillTemplate($content_array)
{
    $data = '';
    $text = '';
    $max = sizeof($content_array);
    $counter = 1;
    for ($i = 0; $i < $max; $i++) {
        $text .=  GetContent($content_array, $i, "templates/recipes_text_template.html");
        if ($counter % 3 === 0 || ($counter === $max)) {
            $content_text_template = file_get_contents("templates/recipes_text_template2.html");
            $content_text_template = str_replace("{text}", $text, $content_text_template);
            $data .= $content_text_template;
            $text = "";
        }
        $counter++;
    }
    return $data;
}

//TEMPLATING

$data = FillTemplate($content_array);
$header = ChangeSignLink($header);
$header = CheckAdmin($header);
$content_template = str_replace("{content_text}", $data, $content_template);
$content_template = str_replace("{content_caption}", $field_array['content_caption'], $content_template);

$template = str_replace('{recipes_content}', $content_template, $template);
$template = str_replace('{title}', $field_array['title'], $template);
$template = str_replace('{header}', $header, $template);
$footer = str_replace('{footer_content}', $field_array['footer'], $footer);
$template = str_replace('{footer}', $footer, $template);

print $template;
