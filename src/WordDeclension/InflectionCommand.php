<?php

declare(strict_types=1);

namespace Shevchenko\WordDeclension;

use Shevchenko\WordDeclension\Enums\InflectionCommandAction;

class InflectionCommand
{
    public function __construct(
        public readonly InflectionCommandAction $action,
        public readonly string $value,
    ) {}
}