<?php

function case_converter_turkish($text, $case = 'lowercase')
{
    $lowercase = ['ç', 'ğ', 'i', 'ı', 'ö', 'ş', 'ü'];
    $uppercase = ['Ç', 'Ğ', 'İ', 'I', 'Ö', 'Ş', 'Ü'];
    switch ($case) {
        case 'lowercase':
            $str_replace = str_replace($uppercase, $lowercase, $text);
            $text = mb_strtolower($str_replace);
            break;
        case 'uppercase':
            $str_replace = str_replace($lowercase, $uppercase, $text);
            $text = mb_strtoupper($str_replace);
            break;
    }
    return $text;
}