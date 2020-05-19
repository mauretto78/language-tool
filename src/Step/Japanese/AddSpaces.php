<?php

namespace Matecat\LanguageTools\Step\Japanese;

use Matecat\LanguageTools\Step\StepInterface;

class AddSpaces implements StepInterface
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
        // Generally, Japanese sentences should not have any spaces between letters and
        // before/after tags/markups/placeholders, except for the following cases:
        $addSpacesMap = [
                '::' => ':: ',
                '-'  => ' - ',
                '•'  => '• ',
        ];

        foreach ($addSpacesMap as $key => $value) {
            $string = str_replace($value, trim($value), $string);
            preg_match('/\\'.$key.'/', $string, $match);

            if(isset($match[0])){
                $string = str_replace($key, $value, $string);
            }
        }

        return $string;
    }
}