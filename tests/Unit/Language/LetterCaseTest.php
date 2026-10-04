<?php

declare(strict_types=1);

namespace Tests\Unit\Language;

use MedCore\UkrainianAnthroponyms\Language\LetterCase;
use PHPUnit\Framework\TestCase;

class LetterCaseTest extends TestCase
{
    public function testCopyLetterCase()
    {
        $this->assertEquals('ТАРАС', LetterCase::copyLetterCase('ТАРАС', 'тарас'));
        $this->assertEquals('тарас', LetterCase::copyLetterCase('тарас', 'ТАРАС'));
        $this->assertEquals('Тарас', LetterCase::copyLetterCase('Тарас', 'тарас'));
        $this->assertEquals('Тарасом', LetterCase::copyLetterCase('Тарас', 'тарасом'));
        $this->assertEquals('ТАРАСОМ', LetterCase::copyLetterCase('ТАРАС', 'тарасом'));
        $this->assertEquals('тарасом', LetterCase::copyLetterCase('тарас', 'ТАРАСОМ'));
        $this->assertEquals('Не-Вказ', LetterCase::copyLetterCase('Не-Вказ', 'не-вказ'));

        // Title case character ǈ (U+01C8) is neither upper nor lower
        $this->assertEquals('A', LetterCase::copyLetterCase('ǈ', 'A'));
    }
}
