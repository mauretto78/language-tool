<?php

namespace Matecat\LanguageTools;

use Matecat\LanguageTools\Step\StepInterface;
use Matecat\LanguageTools\Utils\Strings;

class Pipeline
{
    /**
     * @var array
     */
    private $language;

    /**
     * @var array
     */
    private $config;

    /**
     * Pipeline constructor.
     *
     * @param $languageIsoCode
     */
    public function __construct( $languageIsoCode )
    {
        $this->config = include __DIR__.'/../config/languages.php';

        if ($this->isLanguageSupported($languageIsoCode)) {
            $this->language = $this->config['languages'][$languageIsoCode];
        }
    }

    /**
     * @param string $languageIsoCode
     *
     * @return bool
     */
    public function isLanguageSupported( $languageIsoCode)
    {
        return in_array($languageIsoCode, array_keys($this->config['languages']));
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
        $return = Strings::toUtf8($return);

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
