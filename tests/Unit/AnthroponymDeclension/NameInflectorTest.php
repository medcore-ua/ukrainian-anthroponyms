<?php

declare(strict_types=1);

namespace Tests\Unit\AnthroponymDeclension;

use MedCore\UkrainianAnthroponyms\AnthroponymDeclension\GivenNameInflector;
use MedCore\UkrainianAnthroponyms\Language\GrammaticalCase;
use MedCore\UkrainianAnthroponyms\Language\GrammaticalGender;
use MedCore\UkrainianAnthroponyms\WordDeclension\DeclensionRuleLoader;
use MedCore\UkrainianAnthroponyms\WordDeclension\WordInflector;
use PHPUnit\Framework\TestCase;

class NameInflectorTest extends TestCase
{
    public function testInflectReturnsNullForNullName()
    {
        $rules = DeclensionRuleLoader::loadFromFile(__DIR__ . '/../../../rules/declension-rules.json');
        $wordInflector = new WordInflector($rules);
        $inflector = new GivenNameInflector($wordInflector);

        $result = $inflector->inflect(null, GrammaticalGender::MASCULINE, GrammaticalCase::NOMINATIVE);
        $this->assertNull($result);
    }
}
