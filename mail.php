<?php
include_once('functions.php');
function set_values(){
    $data = [
    "name" => $_POST['name'],
    "email" => $_POST['email'],
    "review" => $_POST['review']  ];
    return $data;
}
function SendMail($data)
{
$to_email = $data["email"];
$subject = "Отзыв на сайте caffeine.com";
$body = "Здравствуйте, " . $data['name'] . ", спасибо за ваш отзыв:\r\n" . $data['review'] . "\r\n\r\nМы обязательно свяжемся с вами в ближайшее время.";
$headers = "From: Caffeine <coffesitetest123@gmail.com>";
mail($to_email, $subject, $body, $headers);
}
if (isset($_POST)) {
    $data = set_values($_POST);
    SendMail($data);
    UploadFieldContent('reviews', $data);
}
header("Location: contact.php");
