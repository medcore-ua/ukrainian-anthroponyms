<?php

declare(strict_types=1);

namespace Tests\Unit\Contracts;

use MedCore\UkrainianAnthroponyms\Contracts\DeclensionInput;
use MedCore\UkrainianAnthroponyms\Language\GrammaticalGender;
use PHPUnit\Framework\TestCase;

class DeclensionInputTest extends TestCase
{
    public function testInputGetters(): void
    {
        $input = new DeclensionInput(
            GrammaticalGender::MASCULINE,
            'Іван',
            'Іванович',
            'Іванов'
        );

        $this->assertEquals(GrammaticalGender::MASCULINE, $input->getGender());
        $this->assertEquals('Іван', $input->getGivenName());
        $this->assertEquals('Іванович', $input->getPatronymicName());
        $this->assertEquals('Іванов', $input->getFamilyName());
    }

    public function testWithGender(): void
    {
        $input = new DeclensionInput(
            GrammaticalGender::FEMININE,
            'Леся'
        );

        $newInput = $input->withGender(GrammaticalGender::MASCULINE);

        $this->assertNotSame($input, $newInput);
        $this->assertEquals(GrammaticalGender::MASCULINE, $newInput->getGender());
        $this->assertEquals('Леся', $newInput->getGivenName());
        $this->assertNull($newInput->getPatronymicName());
        $this->assertNull($newInput->getFamilyName());
    }
}
