<?php

declare(strict_types=1);

namespace Shevchenko\WordDeclension;

class DeclensionPattern
{
    public function __construct(
        public readonly string $find,
        public readonly string $modify,
    ) {}
}