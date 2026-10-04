<?php

declare(strict_types=1);

namespace Tests\Unit;

use MedCore\UkrainianAnthroponyms\Language\GrammaticalCase;
use MedCore\UkrainianAnthroponyms\Language\WordClass;
use MedCore\UkrainianAnthroponyms\WordDeclension\DeclensionPattern;
use MedCore\UkrainianAnthroponyms\WordDeclension\DeclensionRule;
use MedCore\UkrainianAnthroponyms\WordDeclension\DeclensionRuleInflector;
use MedCore\UkrainianAnthroponyms\WordDeclension\GrammaticalCases;
use PHPUnit\Framework\TestCase;

class DeclensionRuleInflectorTest extends TestCase
{
    private function createRule(GrammaticalCases $cases, DeclensionPattern $pattern): DeclensionRule
    {
        return new DeclensionRule(
            'Test rule',
            [],
            WordClass::NOUN,
            [],
            1,
            [],
            $pattern,
            $cases
        );
    }

    public function testEmptyCommandsArrayReturnsOriginalWord(): void
    {
        $cases = new GrammaticalCases([]); // empty
        $pattern = new DeclensionPattern('', '');
        $rule = $this->createRule($cases, $pattern);

        $inflector = new DeclensionRuleInflector($rule);
        $result = $inflector->inflect('Тест', GrammaticalCase::GENITIVE);
        
        $this->assertEquals('Тест', $result);
    }

    public function testEmptyCommandsReturnsOriginalWord(): void
    {
        $cases = new GrammaticalCases(['genitive' => [[]]]); // empty commands array inside
        $pattern = new DeclensionPattern('', '');
        $rule = $this->createRule($cases, $pattern);

        $inflector = new DeclensionRuleInflector($rule);
        $result = $inflector->inflect('Тест', GrammaticalCase::GENITIVE);
        
        $this->assertEquals('Тест', $result);
    }

    public function testNoCommandDataForGroupLeavesValueUnchanged(): void
    {
        $cases = new GrammaticalCases([
            'genitive' => [[
                1 => ['action' => 'replace', 'value' => 'а']
            ]]
        ]);
        $pattern = new DeclensionPattern('т', '(т)');
        $rule = $this->createRule($cases, $pattern);

        $inflector = new DeclensionRuleInflector($rule);
        $result = $inflector->inflect('Тест', GrammaticalCase::GENITIVE);
        
        $this->assertEquals('Тест', $result);
    }

    public function testNonIndexedCommandsArrayReturnsOriginalWord(): void
    {
        // Commands array exists, but index 0 is not set
        $cases = new GrammaticalCases(['genitive' => ['wrong_index' => []]]);
        $pattern = new DeclensionPattern('', '');
        $rule = $this->createRule($cases, $pattern);

        $inflector = new DeclensionRuleInflector($rule);
        $result = $inflector->inflect('Тест', GrammaticalCase::GENITIVE);
        
        $this->assertEquals('Тест', $result);
    }
}
