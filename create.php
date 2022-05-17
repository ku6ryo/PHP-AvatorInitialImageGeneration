<?php
  // Checking if GD is installed
  $testGD = get_extension_funcs("gd");
  if (!$testGD){ echo "GD not installed."; exit; }

  // Settings
  $font_file = "./NotoSans-Medium.ttf";
  $size = 256;
  $font_size = $size * 0.4;
  $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

  // Create an image for each character.
  foreach (str_split($chars) as $initial) {
    $image = @imagecreatetruecolor($size, $size) or die("Cannot Initialize new GD image stream");

    $background_color = imagecolorexact($image, 255, 255, 255);
    imagefill($image, 0, 0, $background_color);

    $text_color = imagecolorexact($image, 0, 0, 0);
    $coords = imagettfbbox($font_size, 0, $font_file, $initial);

    $width = $coords[4] - $coords[0];
    $height = $coords[1] - $coords[5];

    $x = ($size - $width) / 2 - $coords[0];
    $y = ($size - $height) / 2 - $coords[5];

    imagettftext($image, $font_size, 0, $x, $y, $text_color, $font_file, $initial);

    // Draws center lines. This is just for position checking purposes.
    $line_color = imagecolorexact($image, 255, 0, 0);
    imageline($image, $size / 2, 0, $size / 2, $size, $line_color);
    imageline($image, 0, $size / 2, $size, $size / 2, $line_color);

    // Saves the image as a PNG.
    imagepng($image, "./images/" . $initial . ".png");
  }