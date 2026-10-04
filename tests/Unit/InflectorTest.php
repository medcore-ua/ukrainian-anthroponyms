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

        $this->assertEquals('Тараса', $output->givenName);
        $this->assertEquals('Григоровича', $output->patronymicName);
        $this->assertEquals('Шевченка', $output->familyName);
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

        $this->assertEquals('Лесі', $output->givenName);
        $this->assertEquals('Петрівні', $output->patronymicName);
        $this->assertEquals('Українці', $output->familyName);
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
