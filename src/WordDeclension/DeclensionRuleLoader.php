<?php

declare(strict_types=1);

namespace MedCore\UkrainianAnthroponyms\WordDeclension;

use MedCore\UkrainianAnthroponyms\Language\GrammaticalGender;
use MedCore\UkrainianAnthroponyms\Language\WordClass;

class DeclensionRuleLoader
{
    /** @return array<DeclensionRule> */
    public static function loadFromFile(string $filePath): array
    {
        $json = file_get_contents($filePath);
        $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

        return array_map(self::parseRule(...), $data);
    }

    /** @param array<string, mixed> $data */
    private static function parseRule(array $data): DeclensionRule
    {
        return new DeclensionRule(
            description: $data['description'],
            examples: $data['examples'],
            wordClass: WordClass::from($data['wordClass']),
            gender: array_map(GrammaticalGender::from(...), $data['gender']),
            priority: $data['priority'],
            applicationType: $data['applicationType'] ?? [],
            pattern: new DeclensionPattern($data['pattern']['find'], $data['pattern']['modify']),
            grammaticalCases: new GrammaticalCases($data['grammaticalCases']),
        );
    }
}