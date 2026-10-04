<?php

declare(strict_types=1);

namespace Tests\Unit\Contracts;

use MedCore\UkrainianAnthroponyms\Contracts\DeclensionOutput;
use PHPUnit\Framework\TestCase;

class DeclensionOutputTest extends TestCase
{
    public function testDeclensionOutputProperties(): void
    {
        $output = new DeclensionOutput('Прізвище', 'Ім\'я', 'По батькові');
        $this->assertEquals('Прізвище', $output->familyName);
        $this->assertEquals('Ім\'я', $output->givenName);
        $this->assertEquals('По батькові', $output->patronymicName);
    }
}
