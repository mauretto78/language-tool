<?php

namespace Matecat\LanguageTools\Utils;

class TagExtractor
{
    /**
     * @param string $string
     *
     * @return array
     */
    public static function extract($string)
    {
        $map = [];
        
        $regexes = array_merge(self::getMatecatRegexes(), self::getAllHTMLRegexes());

        foreach ($regexes as $regex){
            preg_match_all($regex, $string, $matches, PREG_PATTERN_ORDER);

            if(!empty($matches[0][0])){
                $map[] = $matches[0][0];
            }
        }

        return $map;
    }

    /**
     * @return string[]
     */
    private static function getMatecatRegexes()
    {
        return [
            '/^<ph [^>]+>|<ph [^>]+>$/'
        ];
    }

    /**
     * @return string[]
     */
    private static function getAllHTMLRegexes()
    {
        $regexes = [];

        $htmlTags = [
            'a',
            'abbr',
            'address',
            'area',
            'article',
            'aside',
            'audio',
            'b',
            'base',
            'bdi',
            'bdo',
            'blockquote',
            'body',
            'br',
            'button',
            'canvas',
            'caption',
            'cite',
            'code',
            'col',
            'colgroup',
            'data',
            'datalist',
            'dd',
            'del',
            'details',
            'dfn',
            'dialog',
            'div',
            'dl',
            'dt',
            'em',
            'embed',
            'fieldset',
            'figure',
            'footer',
            'form',
            'h1',
            'h2',
            'h3',
            'h4',
            'h5',
            'h6',
            'head',
            'header',
            'hgroup',
            'hr',
            'html',
            'i',
            'iframe',
            'img',
            'input',
            'ins',
            'kbd',
            'keygen',
            'label',
            'legend',
            'li',
            'link',
            'main',
            'map',
            'mark',
            'menu',
            'menuitem',
            'meta',
            'meter',
            'nav',
            'noscript',
            'object',
            'ol',
            'optgroup',
            'option',
            'output',
            'p',
            'param',
            'pre',
            'q',
            'rb',
            'rp',
            'rt',
            'rtc',
            'ruby',
            's',
            'samp',
            'script',
            'section',
            'select',
            'small',
            'source',
            'span',
            'strong',
            'style',
            'sub',
            'summary',
            'sup',
            'table',
            'tbody',
            'td',
            'template',
            'textarea',
            'tfoot',
            'th',
            'thead',
            'time',
            'title',
            'tr',
            'track',
            'u',
            'ul',
            'var',
            'video',
            'wbr',
        ];

        foreach ($htmlTags as $tagname){
            $regexes[] = "#<\s*?$tagname\b[^>]*>(.*?)</$tagname\b[^>]*>#s";
        }

        return $regexes;
    }
}