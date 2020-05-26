<?php

namespace Matecat\LanguageTools\Step\TraditionalChinese;

use Matecat\LanguageTools\Step\CJK\AbstractAddSpace;
use Matecat\LanguageTools\Utils\Strings;

class AddSpaces extends AbstractAddSpace
{
    public function process( $string )
    {
        $string = parent::process($string);
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