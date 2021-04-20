<?php

//DATA
include_once('functions.php');

$content_array = DownloadContent('indexcontent');
$field_array = DownloadFieldContent('auxiliaryсontent','index');

$header = file_get_contents("templates/header.html");
$footer = file_get_contents("templates/footer.html");
$index_content = file_get_contents("templates/index_content_template.html");
$template = file_get_contents("templates/index.html");

//FUNCTIONS
function FillTemplate($content_array)
{
    $data = '';
    $max = sizeof($content_array);

    for($i = 0; $i < $max; $i++)
    {
        $data .= GetContent($content_array, $i, "templates/index_text_template.html");
    }
    return $data;
}

//TEMPLATING
$data = FillTemplate($content_array);

$index_content = str_replace('{content_caption}', $field_array['content_caption'], $index_content);
$index_content = str_replace('{other_content}', $field_array['other_content'], $index_content);
$index_content = str_replace('{content_text}', $data, $index_content);

$template = str_replace('{index_content}', $index_content, $template);
$template = str_replace('{title}', $field_array['title'], $template);
$template = str_replace('{header}', $header, $template);
$footer = str_replace('{footer_content}',$field_array['footer'],$footer);
$template = str_replace('{footer}', $footer, $template);

print $template;