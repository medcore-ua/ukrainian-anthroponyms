<?php

declare(strict_types=1);

namespace Tests\Unit;

use MedCore\UkrainianAnthroponyms\Contracts\DeclensionInput;
use MedCore\UkrainianAnthroponyms\GenderDetection\GenderDetector;
use MedCore\UkrainianAnthroponyms\Language\GrammaticalGender;
use PHPUnit\Framework\TestCase;

class GenderDetectorTest extends TestCase
{
    private GenderDetector $detector;

    protected function setUp(): void
    {
        $this->detector = new GenderDetector();
    }

    public function testDetectByPatronymicMale(): void
    {
        $input = new DeclensionInput(GrammaticalGender::MASCULINE, 'Іван', 'Степанович');
        $this->assertEquals(GrammaticalGender::MASCULINE, $this->detector->detect($input));
    }

    public function testDetectByGivenNameFemale(): void
    {
        $input = new DeclensionInput(GrammaticalGender::MASCULINE, 'Анна', null);
        $this->assertEquals(GrammaticalGender::FEMININE, $this->detector->detect($input));
    }

    public function testDetectUnknown(): void
    {
        $input = new DeclensionInput(GrammaticalGender::MASCULINE, 'Абвгд', 'Абвгдовиччч');
        $this->assertNull($this->detector->detect($input));
    }

    public function testDetectEmpty(): void
    {
        $input = new DeclensionInput(GrammaticalGender::MASCULINE, null, null, 'Шевченко');
        $this->assertNull($this->detector->detect($input));
    }
}
