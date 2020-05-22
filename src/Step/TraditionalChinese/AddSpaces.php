<?php

namespace Matecat\LanguageTools\Step\TraditionalChinese;

use Matecat\LanguageTools\Step\StepInterface;
use Matecat\LanguageTools\Utils\Strings;

class AddSpaces implements StepInterface
{
    /**
     * We follow the same Japanese rules, but with an additional special role (addHalfSpaceBetweenDoubleDigitAndSingleDigit)
     *
     * For a complete reference see:
     * https://docs.google.com/document/d/1Om1POTD0tRVfqBGEH51WELCQkgpBH2GUSG0gWKMucqk/edit
     *
     * @param string $string
     *
     * @return string
     */
    public function process( $string )
    {
        // Generally, Japanese sentences should not have any spaces between letters and
        // before/after tags/markups/placeholders, except for the following cases:
        $addSpacesMap = [
                '::' => ':: ',
                '-'  => ' - ',
                '•'  => '• ',
        ];

        foreach ($addSpacesMap as $key => $value) {
            $string = str_replace($value, $key, $string);
            preg_match('/'.$key.'/ui', $string, $match);

            if(isset($match[0])){
                $string = str_replace($key, $value, $string);
            }
        }

        $string = $this->addHalfSpaceBetweenDoubleDigitAndSingleDigit($string);

        return $string;
    }

    /**
     * Our general rule for adding a half space is to add it between a double-digit character (e.g.Chinese character and punctuation)
     * and a single-digit character (e.g Roman alphabet/number/ 1 digit symbol/ 1 digit punctuation…etc).
     *
     * @param string $string
     *
     * @return string
     */
    private function addHalfSpaceBetweenDoubleDigitAndSingleDigit($string)
    {
        $return = '';

        $chars = Strings::split($string);

        for ($i=0; $i<count($chars); $i++){

            $return .= $chars[$i];

            if($this->isAChineseChar($chars[$i])){
                if(isset($chars[$i+1])){
                    $next = $chars[$i+1];

                    if(false ===$this->isAChineseChar($next)){
                        $return .= ' ';
                    }
                }
            }
        }

        return $return;
    }

    /**
     * @param string $char
     *
     * @return bool
     */
    private function isAChineseChar($char)
    {
        preg_match_all("/\p{Han}+/u", $char, $matches);

        return false === empty($matches[0]);
    }
}