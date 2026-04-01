<?php

declare(strict_types=1);

namespace MedCore\UkrainianAnthroponyms\WordDeclension;

class DeclensionPattern
{
    public function __construct(
        public readonly string $find,
        public readonly string $modify,
    ) {}
}