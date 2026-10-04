<?php

declare(strict_types=1);

namespace Tests\Unit\WordDeclension;

use MedCore\UkrainianAnthroponyms\WordDeclension\DeclensionRuleLoader;
use PHPUnit\Framework\TestCase;

class DeclensionRuleLoaderTest extends TestCase
{
    public function testLoadFromFile(): void
    {
        $rules = DeclensionRuleLoader::loadFromFile(__DIR__ . '/../../../rules/declension-rules.json');
        $this->assertIsArray($rules);
        $this->assertNotEmpty($rules);
    }
}
