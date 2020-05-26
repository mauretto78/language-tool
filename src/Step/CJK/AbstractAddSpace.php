<?php

namespace Matecat\LanguageTools\Step\CJK;

use Matecat\LanguageTools\Step\StepInterface;
use Matecat\LanguageTools\Utils\TagExtractor;

abstract class AbstractAddSpace implements StepInterface
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
            $string = str_replace($value, $key, $string);
            preg_match('/'.$key.'/ui', $string, $match);

            if(isset($match[0])){
                $string = str_replace($key, $value, $string);
            }
        }

        // restore the "-" (and eventually "::") in special tags present in the original string. Example:
        // at this stage we have:
        // <ph id="mtc_1" equiv - text="base64:Jmx0Oy9hJmd0Ow=="/>
        // and we want to convert to the original form:
        // <ph id="mtc_1" equiv - text="base64:Jmx0Oy9hJmd0Ow=="/>
        $extractTags = TagExtractor::extract($string);

        if(!empty($extractTags)){
            foreach ($extractTags as $extractTag){
                $string = str_replace($extractTag, str_replace(" - ", "-", $extractTag), $string);
                $string = str_replace($extractTag, str_replace(":: ", "::", $extractTag), $string);
            }
        }

        return $string;
    }
}