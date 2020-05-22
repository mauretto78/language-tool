<?php

namespace Matecat\LanguageTools\Tests;

use Matecat\LanguageTools\Pipeline;
use PHPUnit\Framework\TestCase;

class LanguageTest extends TestCase
{
    /**
     * @test
     */
    function dummyLanguage()
    {
        $pipeline = new Pipeline("dummy-lang");
        $string = "ciao";
        $this->assertEquals($string, $pipeline->process($string));
    }

    /**
     * @test
     */
    function supportedLanguages()
    {
        $dataFolder = __DIR__ . '/data/';
        $files = scandir($dataFolder);

        foreach($files as $file) {
            if($file !== '.' and $file !== '..'){
                $pathInfo = pathinfo($dataFolder.$file);
                $pipeline = new Pipeline($pathInfo['filename']);
                $h = fopen( $dataFolder.$file, "r");

                while (($data = fgetcsv($h, 1000, ",")) !== false)
                {
                    $wrong  = $data[0];
                    $target = $data[1];

                    $this->assertEquals($target, $pipeline->process($wrong));
                }
            }
        }
    }
}


