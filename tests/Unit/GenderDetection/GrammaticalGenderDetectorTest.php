<?php

declare(strict_types=1);

namespace Tests\Unit\GenderDetection;

use MedCore\UkrainianAnthroponyms\GenderDetection\GrammaticalGenderDetector;
use PHPUnit\Framework\TestCase;

class GrammaticalGenderDetectorTest extends TestCase
{
    public function testDetectGenderFromPatronymic() : void
    {
        $detector = new GrammaticalGenderDetector('ович|ич', 'івна|івна');

        $this->assertEquals('masculine', $detector->detect('Григорович'));
        $this->assertEquals('feminine', $detector->detect('Григорівна'));
        $this->assertNull($detector->detect('Григорій'));
    }
}
