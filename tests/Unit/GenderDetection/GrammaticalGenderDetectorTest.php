<?php

declare(strict_types=1);

namespace Tests\Unit\GenderDetection;

use MedCore\UkrainianAnthroponyms\GenderDetection\GrammaticalGenderDetector;
use MedCore\UkrainianAnthroponyms\Language\GrammaticalGender;
use PHPUnit\Framework\TestCase;

class GrammaticalGenderDetectorTest extends TestCase
{
    public function testDetectGenderFromPatronymic(): void
    {
        $detector = new GrammaticalGenderDetector();
        
        $this->assertEquals(GrammaticalGender::MASCULINE, $detector->detectGender('Григорович'));
        $this->assertEquals(GrammaticalGender::FEMININE, $detector->detectGender('Григорівна'));
        $this->assertNull($detector->detectGender('Григорій'));
    }
}
