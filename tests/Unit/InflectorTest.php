<?php

declare(strict_types=1);

namespace Tests\Unit;

use MedCore\UkrainianAnthroponyms\Contracts\DeclensionInput;
use MedCore\UkrainianAnthroponyms\Inflector;
use MedCore\UkrainianAnthroponyms\Language\GrammaticalGender;
use PHPUnit\Framework\TestCase;

class InflectorTest extends TestCase
{
    private Inflector $inflector;

    protected function setUp() : void
    {
        $this->inflector = new Inflector();
    }

    public function testInGenitiveForMale() : void
    {
        $input = new DeclensionInput(
            GrammaticalGender::MASCULINE,
            'Тарас',
            'Григорович',
            'Шевченко'
        );

        $output = $this->inflector->inGenitive($input);

        $this->assertEquals('Тараса', $output->getGivenName());
        $this->assertEquals('Григоровича', $output->getPatronymicName());
        $this->assertEquals('Шевченка', $output->getFamilyName());
    }

    public function testInDativeForFemale() : void
    {
        $input = new DeclensionInput(
            GrammaticalGender::FEMININE,
            'Леся',
            'Петрівна',
            'Українка'
        );

        $output = $this->inflector->inDative($input);

        $this->assertEquals('Лесі', $output->getGivenName());
        $this->assertEquals('Петрівні', $output->getPatronymicName());
        $this->assertEquals('Українці', $output->getFamilyName());
    }

    public function testGenderDetectionMale() : void
    {
        $input = new DeclensionInput(
            GrammaticalGender::UNKNOWN,
            'Іван',
            'Степанович'
        );

        $gender = $this->inflector->detectGender($input);
        
        $this->assertEquals(GrammaticalGender::MASCULINE, $gender);
    }
}
