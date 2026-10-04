<?php

declare(strict_types=1);

namespace Tests\Unit\WordDeclension;

use MedCore\UkrainianAnthroponyms\Language\GrammaticalCase;
use MedCore\UkrainianAnthroponyms\Language\GrammaticalGender;
use MedCore\UkrainianAnthroponyms\WordDeclension\WordInflector;
use PHPUnit\Framework\TestCase;

class WordInflectorTest extends TestCase
{
    public function testInflectWithNoRulesReturnsOriginalWord(): void
    {
        $inflector = new WordInflector([]);
        $result = $inflector->inflect('Тест', GrammaticalCase::GENITIVE, GrammaticalGender::MASCULINE);
        
        $this->assertEquals('Тест', $result);
    }
}
