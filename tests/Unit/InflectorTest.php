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

    public function testInNominativeForMale() : void
    {
        $input = new DeclensionInput(GrammaticalGender::MASCULINE, 'Тарас', 'Григорович', 'Шевченко');
        $output = $this->inflector->inNominative($input);

        $this->assertEquals('Тарас', $output->givenName);
        $this->assertEquals('Григорович', $output->patronymicName);
        $this->assertEquals('Шевченко', $output->familyName);
    }

    public function testInGenitiveForMale() : void
    {
        $input = new DeclensionInput(GrammaticalGender::MASCULINE, 'Тарас', 'Григорович', 'Шевченко');
        $output = $this->inflector->inGenitive($input);

        $this->assertEquals('Тараса', $output->givenName);
        $this->assertEquals('Григоровича', $output->patronymicName);
        $this->assertEquals('Шевченка', $output->familyName);
    }

    public function testInDativeForFemale() : void
    {
        $input = new DeclensionInput(GrammaticalGender::FEMININE, 'Леся', 'Петрівна', 'Українка');
        $output = $this->inflector->inDative($input);

        $this->assertEquals('Лесі', $output->givenName);
        $this->assertEquals('Петрівні', $output->patronymicName);
        $this->assertEquals('Українкій', $output->familyName);
    }

    public function testInAccusativeForMale() : void
    {
        $input = new DeclensionInput(GrammaticalGender::MASCULINE, 'Тарас', 'Григорович', 'Шевченко');
        $output = $this->inflector->inAccusative($input);

        $this->assertEquals('Тараса', $output->givenName);
        $this->assertEquals('Григоровича', $output->patronymicName);
        $this->assertEquals('Шевченка', $output->familyName);
    }

    public function testInAblativeForMale() : void
    {
        $input = new DeclensionInput(GrammaticalGender::MASCULINE, 'Тарас', 'Григорович', 'Шевченко');
        $output = $this->inflector->inAblative($input);

        $this->assertEquals('Тарасом', $output->givenName);
        $this->assertEquals('Григоровичем', $output->patronymicName);
        $this->assertEquals('Шевченком', $output->familyName);
    }

    public function testInLocativeForMale() : void
    {
        $input = new DeclensionInput(GrammaticalGender::MASCULINE, 'Тарас', 'Григорович', 'Шевченко');
        $output = $this->inflector->inLocative($input);

        $this->assertEquals('Тарасові', $output->givenName);
        $this->assertEquals('Григоровичу', $output->patronymicName);
        $this->assertEquals('Шевченкові', $output->familyName);
    }

    public function testInVocativeForMale() : void
    {
        $input = new DeclensionInput(GrammaticalGender::MASCULINE, 'Тарас', 'Григорович', 'Шевченко');
        $output = $this->inflector->inVocative($input);

        $this->assertEquals('Тарасе', $output->givenName);
        $this->assertEquals('Григоровичу', $output->patronymicName);
        $this->assertEquals('Шевченку', $output->familyName);
    }

    public function testGenderDetectionMale() : void
    {
        $input = new DeclensionInput(GrammaticalGender::FEMININE, 'Іван', 'Степанович');
        $gender = $this->inflector->detectGender($input);

        $this->assertEquals(GrammaticalGender::MASCULINE, $gender);
    }
}
