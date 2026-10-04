<?php

declare(strict_types=1);

namespace Tests\Unit\AnthroponymDeclension;

use MedCore\UkrainianAnthroponyms\AnthroponymDeclension\FamilyNameInflector;
use MedCore\UkrainianAnthroponyms\Language\GrammaticalCase;
use MedCore\UkrainianAnthroponyms\Language\GrammaticalGender;
use MedCore\UkrainianAnthroponyms\WordDeclension\DeclensionRuleLoader;
use MedCore\UkrainianAnthroponyms\WordDeclension\WordInflector;
use PHPUnit\Framework\TestCase;

class FamilyNameInflectorTest extends TestCase
{
    private FamilyNameInflector $inflector;

    protected function setUp() : void
    {
        $rules = DeclensionRuleLoader::loadFromFile(__DIR__ . '/../../../rules/declension-rules.json');
        $wordInflector = new WordInflector($rules);
        $this->inflector = new FamilyNameInflector($wordInflector);
    }

    public function testMonosyllableNotLastWord() : void
    {
        // "Кім" is monosyllabic. If it's not the last word, it shouldn't be inflected.
        $result = $this->inflector->inflect('Кім', GrammaticalGender::MASCULINE, GrammaticalCase::GENITIVE, false);
        $this->assertEquals('Кім', $result);
    }

    public function testMasculineAdjectiveFamilyName() : void
    {
        // "Великий" ends in "ий" so determineWordClass returns ADJECTIVE
        $result = $this->inflector->inflect('Великий', GrammaticalGender::MASCULINE, GrammaticalCase::GENITIVE);
        $this->assertEquals('Великого', $result);
    }

    public function testFeminineNounFamilyName() : void
    {
        // "Косач" doesn't end in 'а'/'я', so determineWordClass returns NOUN
        $result = $this->inflector->inflect('Косач', GrammaticalGender::FEMININE, GrammaticalCase::GENITIVE);
        $this->assertEquals('Косач', $result);
    }

    public function testMultisyllableNotLastWord() : void
    {
        // "Нечуй" is not monosyllabic. It should be inflected even if not the last word.
        $result = $this->inflector->inflect('Нечуй', GrammaticalGender::MASCULINE, GrammaticalCase::GENITIVE, false);
        $this->assertEquals('Нечуя', $result);
    }
}
