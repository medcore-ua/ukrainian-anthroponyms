<?php

declare(strict_types=1);

namespace Shevchenko\WordDeclension;

class AppendCommandRunner implements InflectionCommandRunnerInterface
{
    public function __construct(
        private readonly InflectionCommand $command,
    ) {}

    public function exec(string $value): string
    {
        return $value . $this->command->value;
    }
}

class ReplaceCommandRunner implements InflectionCommandRunnerInterface
{
    public function __construct(
        private readonly InflectionCommand $command,
    ) {}

    public function exec(string $value): string
    {
        return $this->command->value;
    }
}