<?php

declare(strict_types=1);

namespace Shevchenko\Contracts;

use Shevchenko\Language\GrammaticalGender;

interface DeclensionInputInterface
{
    public function getGender(): GrammaticalGender;
    public function getGivenName(): ?string;
    public function getPatronymicName(): ?string;
    public function getFamilyName(): ?string;
}