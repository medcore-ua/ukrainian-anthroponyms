<?php

declare(strict_types=1);

namespace MedCore\UkrainianAnthroponyms\Language;

final class LetterCase
{
    public static function copyLetterCase(string $templateWord, string $targetWord): string
    {
        $result = '';
        $templateLength = mb_strlen($templateWord);
        $targetLength = mb_strlen($targetWord);

        for ($i = 0; $i < $targetLength; $i++) {
            $templateIndex = min($i, $templateLength - 1);
            $templateLetter = mb_substr($templateWord, $templateIndex, 1);
            $targetLetter = mb_substr($targetWord, $i, 1);

            if (self::isUpperCase($templateLetter)) {
                $result .= mb_strtoupper($targetLetter, 'UTF-8');
            } elseif (self::isLowerCase($templateLetter)) {
                $result .= mb_strtolower($targetLetter, 'UTF-8');
            } else {
                $result .= $targetLetter;
            }
        }

        return $result;
    }

    private static function isUpperCase(string $letter): bool
    {
        return $letter === mb_strtoupper($letter, 'UTF-8');
    }

    private static function isLowerCase(string $letter): bool
    {
        return $letter === mb_strtolower($letter, 'UTF-8');
    }
}