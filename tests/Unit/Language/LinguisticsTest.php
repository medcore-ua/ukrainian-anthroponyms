<?php

declare(strict_types=1);

namespace Tests\Unit\Language;

use MedCore\UkrainianAnthroponyms\Language\Linguistics;
use PHPUnit\Framework\TestCase;

class LinguisticsTest extends TestCase
{
    public function testIsMonosyllable(): void
    {
        $this->assertTrue(Linguistics::isMonosyllable('Кім'));
        $this->assertFalse(Linguistics::isMonosyllable('Тарас'));
        $this->assertFalse(Linguistics::isMonosyllable(''));
    }
}
