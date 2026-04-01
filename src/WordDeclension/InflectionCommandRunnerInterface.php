<?php

declare(strict_types=1);

namespace Shevchenko\WordDeclension;

interface InflectionCommandRunnerInterface
{
    public function exec(string $value): string;
}