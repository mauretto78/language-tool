<?php

namespace Matecat\LanguageTools\Step;

interface StepInterface
{
    /**
     * @param string $string
     *
     * @return string
     */
    public function process($string);
}
