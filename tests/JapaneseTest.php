<?php

namespace Matecat\LanguageTools\Tests;

use Matecat\LanguageTools\Pipeline;
use PHPUnit\Framework\TestCase;

class JapaneseTest extends TestCase
{
    /**
     * @test
     */
    function pipeline()
    {
        $pipeline = new Pipeline("ja-JP");

        $h = fopen(__DIR__.'/data/jap.csv', "r");
        while (($data = fgetcsv($h, 1000, ",")) !== false)
        {
            $wrong  = $data[0];
            $target = $data[1];

           $this->assertEquals($target, $pipeline->process($wrong));
        }
    }
}


