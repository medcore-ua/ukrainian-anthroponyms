<?php

declare(strict_types=1);

namespace Tests\Unit\WordDeclension;

use MedCore\UkrainianAnthroponyms\Language\GrammaticalCase;
use MedCore\UkrainianAnthroponyms\WordDeclension\GrammaticalCases;
use PHPUnit\Framework\TestCase;

class GrammaticalCasesTest extends TestCase
{
    public function testForCase() : void
    {
        $cases = new GrammaticalCases(['genitive' => ['test']]);
        $this->assertEquals(['test'], $cases->forCase(GrammaticalCase::GENITIVE));
        $this->assertEquals([], $cases->forCase(GrammaticalCase::NOMINATIVE));
    }
}
