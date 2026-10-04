<?php

declare(strict_types=1);

namespace MedCore\UkrainianAnthroponyms\WordDeclension;

use MedCore\UkrainianAnthroponyms\Language\GrammaticalGender;
use MedCore\UkrainianAnthroponyms\Language\WordClass;

class DeclensionRuleLoader
{
    /** @return array<int, DeclensionRule> */
    public static function loadFromFile(string $filePath) : array
    {
        $json = file_get_contents($filePath);
        if (! is_string($json)) {
            throw new \RuntimeException(sprintf('Could not read file "%s".', $filePath));
        }

        $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        if (! is_array($data)) {
            throw new \RuntimeException('Invalid JSON data format.');
        }

        /** @var array<int, array<string, mixed>> $data */
        return array_map(self::parseRule(...), $data);
    }

    /** @param array<string, mixed> $data */
    private static function parseRule(array $data) : DeclensionRule
    {
        $wordClassVal = $data['wordClass'] ?? '';
        $wordClass = WordClass::from(is_scalar($wordClassVal) ? (string) $wordClassVal : '');

        $genderData = isset($data['gender']) && is_array($data['gender']) ? $data['gender'] : [];
        /** @var array<int, \MedCore\UkrainianAnthroponyms\Language\GrammaticalGender> $gender */
        $gender = array_map(fn (mixed $g) => GrammaticalGender::from(is_scalar($g) ? (string) $g : ''), $genderData);

        $patternData = isset($data['pattern']) && is_array($data['pattern']) ? $data['pattern'] : [];
        $find = isset($patternData['find']) && is_string($patternData['find']) ? $patternData['find'] : '';
        $modify = isset($patternData['modify']) && is_string($patternData['modify']) ? $patternData['modify'] : '';

        /** @var array<string, array<mixed>> $casesData */
        $casesData = isset($data['grammaticalCases']) && is_array($data['grammaticalCases']) ? $data['grammaticalCases'] : [];

        /** @var array<int, string> $examples */
        $examples = isset($data['examples']) && is_array($data['examples']) ? $data['examples'] : [];
        /** @var array<int, int|string> $appType */
        $appType = isset($data['applicationType']) && is_array($data['applicationType']) ? $data['applicationType'] : [];

        return new DeclensionRule(
            description: isset($data['description']) && is_string($data['description']) ? $data['description'] : '',
            examples: $examples,
            wordClass: $wordClass,
            gender: $gender,
            priority: isset($data['priority']) && is_numeric($data['priority']) ? (int) $data['priority'] : 0,
            applicationType: $appType,
            pattern: new DeclensionPattern($find, $modify),
            grammaticalCases: new GrammaticalCases($casesData),
        );
    }
}