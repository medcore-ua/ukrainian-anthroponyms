<?php

declare(strict_types=1);

namespace Shevchenko\AnthroponymDeclension;

use Shevchenko\Language\GrammaticalCase;
use Shevchenko\Language\GrammaticalGender;
use Shevchenko\WordDeclension\WordInflector;

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