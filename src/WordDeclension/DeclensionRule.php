<?php

declare(strict_types=1);

namespace Shevchenko\WordDeclension;

use Shevchenko\Language\WordClass;

class DeclensionRule
{
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