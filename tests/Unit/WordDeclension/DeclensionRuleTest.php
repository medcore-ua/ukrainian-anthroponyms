<?php

declare(strict_types=1);

namespace Tests\Unit\WordDeclension;

use MedCore\UkrainianAnthroponyms\Language\WordClass;
use MedCore\UkrainianAnthroponyms\WordDeclension\DeclensionPattern;
use MedCore\UkrainianAnthroponyms\WordDeclension\DeclensionRule;
use MedCore\UkrainianAnthroponyms\WordDeclension\GrammaticalCases;
use PHPUnit\Framework\TestCase;

class DeclensionRuleTest extends TestCase
{
    public function testProperties(): void
    {
        $cases = new GrammaticalCases([]);
        $pattern = new DeclensionPattern('f', 'm');
        $rule = new DeclensionRule('desc', [], WordClass::NOUN, [], 1, [], $pattern, $cases);
        $this->assertEquals('desc', $rule->description);
        $this->assertEquals(WordClass::NOUN, $rule->wordClass);
    }
}
