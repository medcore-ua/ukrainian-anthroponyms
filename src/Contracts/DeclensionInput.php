<?php

declare(strict_types=1);

namespace Shevchenko\Contracts;

use Shevchenko\Language\GrammaticalGender;

class DeclensionInput implements DeclensionInputInterface
{
    public function __construct(
        private readonly GrammaticalGender $gender,
        private readonly ?string $givenName = null,
        private readonly ?string $patronymicName = null,
        private readonly ?string $familyName = null,
    ) {}

    public function getGender(): GrammaticalGender
    {
        return $this->gender;
    }

    public function getGivenName(): ?string
    {
        return $this->givenName;
    }

    public function getPatronymicName(): ?string
    {
        return $this->patronymicName;
    }

    public function getFamilyName(): ?string
    {
        return $this->familyName;
    }

    public function withGender(GrammaticalGender $gender): self
    {
        return new self(
            $gender,
            $this->givenName,
            $this->patronymicName,
            $this->familyName,
        );
    }
}