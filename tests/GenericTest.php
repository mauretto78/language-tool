<?php

namespace Matecat\LanguageTools\Tests;

use Matecat\LanguageTools\Pipeline;
use PHPUnit\Framework\TestCase;

class GenericTest extends TestCase
{
    /**
     * @test
     */
    function pipeline()
    {
        $pipeline = new Pipeline("dummy-lang");
        $string = "ciao";
        $this->assertEquals($string, $pipeline->process($string));
    }
}


