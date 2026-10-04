<?php

declare(strict_types=1);

namespace Tests\Unit\WordDeclension\Enums;

use MedCore\UkrainianAnthroponyms\WordDeclension\Enums\InflectionCommandAction;
use PHPUnit\Framework\TestCase;

class InflectionCommandActionTest extends TestCase
{
    public function testEnumValues() : void
    {
        $this->assertEquals('append', InflectionCommandAction::APPEND->value);
    }
}
