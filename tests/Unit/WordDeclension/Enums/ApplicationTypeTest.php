<?php

declare(strict_types=1);

namespace Tests\Unit\WordDeclension\Enums;

use MedCore\UkrainianAnthroponyms\WordDeclension\Enums\ApplicationType;
use PHPUnit\Framework\TestCase;

class ApplicationTypeTest extends TestCase
{
    public function testEnumValues(): void
    {
        $this->assertEquals('firstName', ApplicationType::GIVEN_NAME->value);
    }
}
