<?php

declare(strict_types=1);

namespace MedCore\UkrainianAnthroponyms\WordDeclension;

use MedCore\UkrainianAnthroponyms\Language\WordClass;

class DeclensionRule
{
    /**
     * @param array<int, string>                                                    $examples
     * @param array<int, \MedCore\UkrainianAnthroponyms\Language\GrammaticalGender> $gender
     * @param array<int, int|string>                                                $applicationType
     */
    public function __construct(
        public readonly string $description,
        public readonly array $examples,
        public readonly WordClass $wordClass,
        public readonly array $gender,
        public readonly int $priority,
        public readonly array $applicationType,
        public readonly DeclensionPattern $pattern,
        public readonly GrammaticalCases $grammaticalCases,
    ) {}
}