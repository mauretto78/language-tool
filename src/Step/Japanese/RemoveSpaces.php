<?php

namespace Matecat\LanguageTools\Step\Japanese;

use Matecat\LanguageTools\Step\StepInterface;
use Matecat\LanguageTools\Utils\Strings;

class RemoveSpaces implements StepInterface
{
    /**
     * For a complete reference see:
     * https://docs.google.com/document/d/1Om1POTD0tRVfqBGEH51WELCQkgpBH2GUSG0gWKMucqk/edit
     *
     * @param string $string
     *
     * @return string
     */
    public function process( $string )
    {
        // trim
        $string = Strings::trim($string);

        // remove extra spaces
        $string = Strings::removeExtraWhiteSpaces($string);

        // No spaces after a comma, a period, a question mark and an exclamation mark.
        // While it is grammatically correct to have space before an opening parenthesis in English, the opposite is true in Japanese (i.e. no space).
        $string = $this->removeSpacesAfterOrBeforeCommasPeriods($string);

        // No spaces before and/or after placeholders.
        $string = $this->removeSpacesAfterOrBeforePlaceholders($string);

        // For quotation marks, use (「」) in Japanese.
        // There should be no space between the quotation marks and the enclosed word or phrase.
        $string = $this->removeSpacesInsideTheQuotationMarks($string);

        return $string;
    }

    /**
     * @param $string
     *
     * @return string
     */
    private function removeSpacesAfterOrBeforeCommasPeriods( $string)
    {
         $removeSpacesFrom = [
            '。 ',
            '、 ',
            '? ',
            '! ',
            ' （',
            '） ',
        ];

        foreach ($removeSpacesFrom as $value) {
            $string = str_replace($value, Strings::trim($value), $string);
        }

        return $string;
    }

    /**
     * @param string $string
     *
     * @return string
     */
    private function removeSpacesAfterOrBeforePlaceholders($string)
    {
        preg_match_all('/%\{(.*?)\}/ui', $string, $matches);

        foreach ($matches[0] as $index => $match){
            if(isset($matches[1][$index])){
                $string = str_replace([' '.$match, $match.' ', ' '.$match.' '], $match, $string);
            }
        }

        return $string;
    }

    /**
     * @param string $string
     *
     * @return string
     */
    private function removeSpacesInsideTheQuotationMarks($string)
    {
        preg_match_all('/「(.*?)」/ui', $string, $matches);

        foreach ($matches[0] as $index => $match){
            if(isset($matches[1][$index])){
                $string = str_replace($match, '「'.Strings::trim($matches[1][$index]).'」', $string);
            }
        }

        return $string;
    }
}
