<?php

session_start();

$width = 120;
$height = 40;
$image = imagecreatetruecolor($width, $height);

$bg_color = imagecolorallocate($image, 255, 255, 255); 
$text_color = imagecolorallocate($image, 0, 0, 0); 
$line_color = imagecolorallocate($image, 64, 64, 64); 


imagefilledrectangle($image, 0, 0, $width, $height, $bg_color);

$captcha_text = substr(md5(rand()), 0, 6);
$_SESSION['captcha_text'] = $captcha_text;


for ($i = 0; $i < 5; $i++) {
    imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $line_color);
}


imagettftext($image, 20, 0, 10, 30, $text_color, './arial.ttf', $captcha_text);


header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);

?>