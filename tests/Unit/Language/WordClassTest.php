<?php

declare(strict_types=1);

namespace Tests\Unit\Language;

use MedCore\UkrainianAnthroponyms\Language\WordClass;
use PHPUnit\Framework\TestCase;

class WordClassTest extends TestCase
{
    public function testEnumValues() : void
    {
        $this->assertEquals('noun', WordClass::NOUN->value);
    }
}
