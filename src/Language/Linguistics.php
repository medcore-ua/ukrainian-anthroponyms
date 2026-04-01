<?php

declare(strict_types=1);

namespace MedCore\UkrainianAnthroponyms\Language;

final class Linguistics
{
    private const VOWEL_PATTERN = '/[аоуеиіяюєї]/iu';

    public static function countSyllables(string $word): int
    {
        preg_match_all(self::VOWEL_PATTERN, $word, $matches);
        return count($matches[0]);
    }

    public static function isMonosyllable(string $word): bool
    {
        return self::countSyllables($word) === 1;
    }
}