<?php

declare(strict_types=1);

namespace Tests\Unit\AnthroponymDeclension;

use MedCore\UkrainianAnthroponyms\AnthroponymDeclension\PatronymicNameInflector;
use MedCore\UkrainianAnthroponyms\Language\GrammaticalCase;
use MedCore\UkrainianAnthroponyms\Language\GrammaticalGender;
use MedCore\UkrainianAnthroponyms\WordDeclension\DeclensionRuleLoader;
use MedCore\UkrainianAnthroponyms\WordDeclension\WordInflector;
use PHPUnit\Framework\TestCase;

class PatronymicNameInflectorTest extends TestCase
{
    public function testInflectPatronymicName() : void
    {
        $rules = DeclensionRuleLoader::loadFromFile(__DIR__ . '/../../../rules/declension-rules.json');
        $wordInflector = new WordInflector($rules);
        $inflector = new PatronymicNameInflector($wordInflector);

        $result = $inflector->inflect('Григорович', GrammaticalGender::MASCULINE, GrammaticalCase::GENITIVE);
        $this->assertEquals('Григоровича', $result);
    }
}
