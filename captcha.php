<?php
session_start();

// Generate a random string of characters
$length = 6;
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$captcha = '';
for ($i = 0; $i < $length; $i++) {
    $captcha .= $characters[rand(0, strlen($characters) - 1)];
}

// Save the captcha in the session
$_SESSION['captcha'] = $captcha;

// Create an image with the captcha text
$image = imagecreatetruecolor(80, 40);
$bg_color = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);
imagefilledrectangle($image, 0, 0, 80, 40, $bg_color);
imagettftext($image, 8, 0, 10, 26, $text_color, 'arial.ttf', $captcha);

// Output the image as PNG
header('Content-Type: image/png');
imagepng($image);

// Clean up
imagedestroy($image);
?>