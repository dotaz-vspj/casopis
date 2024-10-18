<?php 

// make function that extract number from string after the '-' character
function extractNumber($string) {
    $parts = explode('-', $string);
    return [$parts[0], $parts[1]];
}
