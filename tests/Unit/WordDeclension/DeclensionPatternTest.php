<?php

declare(strict_types=1);

namespace Tests\Unit\WordDeclension;

use MedCore\UkrainianAnthroponyms\WordDeclension\DeclensionPattern;
use PHPUnit\Framework\TestCase;

class DeclensionPatternTest extends TestCase
{
    public function testProperties(): void
    {
        $pattern = new DeclensionPattern('find', 'modify');
        $this->assertEquals('find', $pattern->find);
        $this->assertEquals('modify', $pattern->modify);
    }
}
