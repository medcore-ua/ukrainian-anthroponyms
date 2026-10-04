<?php

declare(strict_types=1);

namespace Tests\Unit\Language;

use MedCore\UkrainianAnthroponyms\Language\GrammaticalGender;
use PHPUnit\Framework\TestCase;

class GrammaticalGenderTest extends TestCase
{
    public function testEnumValues() : void
    {
        $this->assertEquals('masculine', GrammaticalGender::MASCULINE->value);
    }
}
