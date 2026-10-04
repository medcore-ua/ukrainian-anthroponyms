<?php

declare(strict_types=1);

namespace Tests\Unit\Language;

use MedCore\UkrainianAnthroponyms\Language\GrammaticalCase;
use PHPUnit\Framework\TestCase;

class GrammaticalCaseTest extends TestCase
{
    public function testEnumValues() : void
    {
        $this->assertEquals('nominative', GrammaticalCase::NOMINATIVE->value);
    }
}
