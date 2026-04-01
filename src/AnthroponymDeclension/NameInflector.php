<?php

declare(strict_types=1);

namespace MedCore\UkrainianAnthroponyms\AnthroponymDeclension;

use MedCore\UkrainianAnthroponyms\Language\GrammaticalCase;
use MedCore\UkrainianAnthroponyms\Language\GrammaticalGender;
use MedCore\UkrainianAnthroponyms\WordDeclension\WordInflector;

abstract class NameInflector
{
    protected function __construct(
        protected readonly WordInflector $wordInflector,
    ) {}

    abstract protected function inflectNamePart(
        string $name,
        GrammaticalGender $gender,
        GrammaticalCase $grammaticalCase,
        bool $isLastWord = true,
    ): string;

    public function inflect(
        ?string $name,
        GrammaticalGender $gender,
        GrammaticalCase $grammaticalCase,
        bool $isLastWord = true,
    ): ?string {
        if ($name === null) {
            return null;
        }

        return $this->inflectNamePart($name, $gender, $grammaticalCase, $isLastWord);
    }
}