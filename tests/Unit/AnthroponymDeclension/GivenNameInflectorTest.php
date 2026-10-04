<?php

declare(strict_types=1);

namespace Tests\Unit\AnthroponymDeclension;

use MedCore\UkrainianAnthroponyms\AnthroponymDeclension\GivenNameInflector;
use MedCore\UkrainianAnthroponyms\Language\GrammaticalCase;
use MedCore\UkrainianAnthroponyms\Language\GrammaticalGender;
use MedCore\UkrainianAnthroponyms\WordDeclension\DeclensionRuleLoader;
use MedCore\UkrainianAnthroponyms\WordDeclension\WordInflector;
use PHPUnit\Framework\TestCase;

class GivenNameInflectorTest extends TestCase
{
    public function testInflectGivenName(): void
    {
        $rules = DeclensionRuleLoader::loadFromFile(__DIR__ . '/../../../rules/declension-rules.json');
        $wordInflector = new WordInflector($rules);
        $inflector = new GivenNameInflector($wordInflector);
        
        $result = $inflector->inflect('Тарас', GrammaticalGender::MASCULINE, GrammaticalCase::GENITIVE);
        $this->assertEquals('Тараса', $result);
    }
}
