<?php

namespace Matecat\LanguageTools\Utils;

class Strings
{
    /**
     * @param string $string
     *
     * @return string
     */
    public static function removeExtraWhiteSpaces($string)
    {
        return preg_replace('/\s+/', ' ', $string);
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public static function trim($string)
    {
        return trim($string);
    }
}