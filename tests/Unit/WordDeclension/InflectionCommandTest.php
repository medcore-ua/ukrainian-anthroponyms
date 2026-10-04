<?php

declare(strict_types=1);

namespace Tests\Unit\WordDeclension;

use MedCore\UkrainianAnthroponyms\WordDeclension\Enums\InflectionCommandAction;
use MedCore\UkrainianAnthroponyms\WordDeclension\InflectionCommand;
use PHPUnit\Framework\TestCase;

class InflectionCommandTest extends TestCase
{
    public function testProperties(): void
    {
        $command = new InflectionCommand(InflectionCommandAction::APPEND, 'value');
        $this->assertEquals(InflectionCommandAction::APPEND, $command->action);
        $this->assertEquals('value', $command->value);
    }
}
