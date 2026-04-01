<?php

declare(strict_types=1);

namespace MedCore\UkrainianAnthroponyms\WordDeclension;

use MedCore\UkrainianAnthroponyms\WordDeclension\Enums\InflectionCommandAction;

class InflectionCommand
{
    public function __construct(
        public readonly InflectionCommandAction $action,
        public readonly string $value,
    ) {}
}