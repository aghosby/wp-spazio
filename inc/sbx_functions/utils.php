<?php

/**
 * SBX Starter Theme - Utility functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package SBX_Starter_Theme
 */

/**
 * Truncate paragraphs 
 */

function truncate($string, $length = 150, $append = "&hellip;")
{
    $string = trim($string);

    if (strlen($string) > $length) {
        $string = wordwrap($string, $length);
        $string = explode("\n", $string, 2);
        $string = $string[0] . $append;
    }

    return $string;
}

/**
 * Convert string to title case 
 */

function title_case($title)
{
    $small_words_array = array('of', 'a', 'the', 'and', 'an', 'or', 'nor', 'but', 'is', 'if', 'then', 'else', 'when', 'at', 'from', 'by', 'on', 'off', 'for', 'in', 'to', 'into', 'with', 'it', 'as');

    // Split the string into separate words
    $words = explode(' ', $title);

    foreach ($words as $key => $word) {

        // If this word is the first, or it's not one of our small words, capitalise it
        // with ucwords().
        if ($key == 0 or !in_array(strip_tags($word), $small_words_array)) {
            $old = strip_tags($word);
            $new = ucfirst($old);
            $words[$key] = str_replace($old, $new, $word);
        }
    }

    // Join the words back into a string
    $new_title = implode(' ', $words);

    return $new_title;
}
