<?php

declare(strict_types=1);

namespace MedCore\UkrainianAnthroponyms\WordDeclension;

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