<?php

declare(strict_types=1);

namespace Tests\Unit\WordDeclension;

use MedCore\UkrainianAnthroponyms\WordDeclension\AppendCommandRunner;
use MedCore\UkrainianAnthroponyms\WordDeclension\Enums\InflectionCommandAction;
use MedCore\UkrainianAnthroponyms\WordDeclension\InflectionCommand;
use PHPUnit\Framework\TestCase;

class AppendCommandRunnerTest extends TestCase
{
    public function testExec() : void
    {
        $command = new InflectionCommand(InflectionCommandAction::APPEND, 'а');
        $runner = new AppendCommandRunner($command);
        $this->assertEquals('теста', $runner->exec('тест'));
    }
}
