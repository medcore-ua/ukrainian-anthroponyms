<?php

declare(strict_types=1);

namespace MedCore\UkrainianAnthroponyms\Contracts;

class DeclensionOutput
{
    public function __construct(
        public readonly ?string $givenName = null,
        public readonly ?string $patronymicName = null,
        public readonly ?string $familyName = null,
    ) {}
}