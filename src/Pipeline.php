<?php

namespace Matecat\LanguageTools;

use Matecat\LanguageTools\Step\StepInterface;
use Symfony\Component\Yaml\Yaml;

class Pipeline
{
    /**
     * @var string
     */
    private $language;

    /**
     * Pipeline constructor.
     *
     * @param $languageIsoCode
     */
    public function __construct( $languageIsoCode )
    {
        $config = include __DIR__.'/../config/languages.php';
        $languages = $config['languages'];

        if (in_array($languageIsoCode, array_keys($languages))) {
            $this->language = $languages[$languageIsoCode];
        }
    }

    /**
     * @param string $original
     *
     * @return string
     */
    public function process( $original )
    {
        if( false === isset($this->language) ){
            return $original;
        }

        $return = $original;
        $namespace = 'Matecat\\LanguageTools\\Step\\' . $this->language['name'] . '\\';

        foreach ($this->language['steps'] as $step){
            $stepClassName = $namespace.$step;

            /** @var StepInterface $stepClass */
            $stepClass = new $stepClassName();
            $return = $stepClass->process($return);
        }

        return $return;
    }
}