<?php

declare(strict_types=1);

namespace Tests\Unit\WordDeclension;

use MedCore\UkrainianAnthroponyms\WordDeclension\Enums\InflectionCommandAction;
use MedCore\UkrainianAnthroponyms\WordDeclension\InflectionCommand;
use MedCore\UkrainianAnthroponyms\WordDeclension\ReplaceCommandRunner;
use PHPUnit\Framework\TestCase;

class ReplaceCommandRunnerTest extends TestCase
{
    public function testExec(): void
    {
        $command = new InflectionCommand(InflectionCommandAction::REPLACE, 'а');
        $runner = new ReplaceCommandRunner($command);
        $this->assertEquals('а', $runner->exec('тест'));
    }
}
