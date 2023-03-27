<?php
function lineToArray( string $string){
    return explode(PHP_EOL, $string);
}

function slugify($text, string $divider ='-')
{
    // Replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
    // Transliterate
    setlocale(LC_ALL, 'en_US.utf8');
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    // Remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);
    // Trim
    $text = trim($text, $divider);
    // Remove duplicate -
    $text = preg_replace('~-+~', $divider, $text);
    // Lowercase
    $text = strtolower($text);
    // Check if it is empty
    if (empty($text)) { return 'n-a'; }
    // Return result
    return $text;
}