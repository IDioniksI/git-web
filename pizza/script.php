<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $size = $_POST["size"];
    $width = $size;
    $height = $size;

    $image = imagecreate($width, $height);

    $background_color = imagecolorallocate($image, 255, 255, 255);

    $line_color = imagecolorallocate($image, 0, 0, 0);

    $rect_x1 = rand(10, $width - 50);
    $rect_y1 = rand(10, $height - 50);
    $rect_x2 = rand($rect_x1 + 20, $width - 10);
    $rect_y2 = rand($rect_y1 + 20, $height - 10);

    $ellipse_x = rand($rect_x1, $rect_x2);
    $ellipse_y = rand($rect_y1, $rect_y2);
    $ellipse_width = rand(20, $width - $ellipse_x);
    $ellipse_height = rand(20, $height - $ellipse_y);

    $triangle_x1 = rand(10, $width - 50);
    $triangle_y1 = rand(10, $height - 50);
    $triangle_x2 = rand($triangle_x1 + 20, $width - 10);
    $triangle_y2 = rand($triangle_y1 + 20, $height - 10);
    $triangle_x3 = rand($triangle_x1 + 10, $width - 30);
    $triangle_y3 = rand($triangle_y1 + 10, $height - 30);

    $ellipse_fill_color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));

    imagerectangle($image, $rect_x1, $rect_y1, $rect_x2, $rect_y2, $line_color);

    imagefilledellipse($image, $ellipse_x, $ellipse_y, $ellipse_width, $ellipse_height, $ellipse_fill_color);
    imageellipse($image, $ellipse_x, $ellipse_y, $ellipse_width, $ellipse_height, $line_color);

    imageline($image, $triangle_x1, $triangle_y1, $triangle_x2, $triangle_y2, $line_color);
    imageline($image, $triangle_x2, $triangle_y2, $triangle_x3, $triangle_y3, $line_color);
    imageline($image, $triangle_x3, $triangle_y3, $triangle_x1, $triangle_y1, $line_color);

    $filename = 'cache/generated_image.png';
    imagepng($image, $filename);

    imagedestroy($image);

    header("Location: contacts.php?filename=$filename");
}
?>