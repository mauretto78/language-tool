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

    /**
     * @param string $string
     *
     * @return array
     */
    public static function split($string)
    {
        preg_match_all('/./u', $string, $matches);

        return (empty($matches[0])) ? [] : $matches[0];
    }

    /**
     * @param string $string
     *
     * @return false|int
     */
    public static function strlen($string)
    {
        return mb_detect_encoding($string) == "UTF-8" ? mb_strlen($string, "UTF-8") : strlen($string);
    }

    /**
     * @param string $string
     *
     * @return false|string
     */
    public static function toUtf8($string)
    {
        return iconv(mb_detect_encoding($string, mb_detect_order(), true), "UTF-8", $string);
    }
}