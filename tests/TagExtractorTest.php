<?php

namespace Matecat\LanguageTools\Tests;

use Matecat\LanguageTools\Utils\TagExtractor;
use PHPUnit\Framework\TestCase;

class TagExtractorTest extends TestCase
{
    /**
     * @test
     */
    function extract()
    {
        $string = "滞在が影響を受けるかどうかを確認するには、ヘルプセンターの旅行制限と注意事項のセクションを確認することをお勧めします。<ph id=mtc_1\" equiv-text=\"base64:Jmx0Oy9hJmd0Ow==\"/>";

        $expected = [
            '<ph id="mtc_1" equiv - text="base64:Jmx0Oy9hJmd0Ow=="/>'
        ];
        $extracted = TagExtractor::extract($string);

        $this->assertEquals(asort($expected), asort($extracted));
        $this->assertCount(1, $extracted);
    }
}