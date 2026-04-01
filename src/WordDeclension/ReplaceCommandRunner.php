<?php

declare(strict_types=1);

namespace MedCore\UkrainianAnthroponyms\WordDeclension;

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