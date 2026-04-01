<?php

declare(strict_types=1);

namespace MedCore\UkrainianAnthroponyms\WordDeclension;

interface InflectionCommandRunnerInterface
{
    public function exec(string $value): string;
}