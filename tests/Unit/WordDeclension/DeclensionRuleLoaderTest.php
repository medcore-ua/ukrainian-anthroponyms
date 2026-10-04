<?php

declare(strict_types=1);

namespace Tests\Unit\WordDeclension;

use MedCore\UkrainianAnthroponyms\WordDeclension\DeclensionRuleLoader;
use PHPUnit\Framework\TestCase;

class DeclensionRuleLoaderTest extends TestCase
{
    public function testLoadFromFile() : void
    {
        $rules = DeclensionRuleLoader::loadFromFile(__DIR__ . '/../../../rules/declension-rules.json');
        $this->assertIsArray($rules);
        $this->assertNotEmpty($rules);
    }

    public function testLoadFromFileThrowsOnMissingFile() : void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Could not read file');
        @DeclensionRuleLoader::loadFromFile(__DIR__ . '/missing-rules-file.json');
    }

    public function testLoadFromFileThrowsOnInvalidDataFormat() : void
    {
        $tmp = tempnam(sys_get_temp_dir(), 'test_json');
        if (false === $tmp) {
            $this->markTestSkipped('Cannot create temp file');
        }

        file_put_contents($tmp, '"just_a_string_not_an_array"');

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Invalid JSON data format.');

        try {
            DeclensionRuleLoader::loadFromFile($tmp);
        } finally {
            unlink($tmp);
        }
    }
}
