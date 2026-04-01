<?php

declare(strict_types=1);

namespace MedCore\UkrainianAnthroponyms\Contracts;

use MedCore\UkrainianAnthroponyms\Language\GrammaticalGender;

interface DeclensionInputInterface
{
    public function getGender(): GrammaticalGender;
    public function getGivenName(): ?string;
    public function getPatronymicName(): ?string;
    public function getFamilyName(): ?string;
}