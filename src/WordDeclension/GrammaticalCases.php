<?php

declare(strict_types=1);

namespace Shevchenko\WordDeclension;

class GrammaticalCases
{
    public readonly array $nominative;
    public readonly array $genitive;
    public readonly array $dative;
    public readonly array $accusative;
    public readonly array $ablative;
    public readonly array $locative;
    public readonly array $vocative;

    public function __construct(array $data)
    {
        $this->nominative = $data['nominative'] ?? [];
        $this->genitive = $data['genitive'] ?? [];
        $this->dative = $data['dative'] ?? [];
        $this->accusative = $data['accusative'] ?? [];
        $this->ablative = $data['ablative'] ?? [];
        $this->locative = $data['locative'] ?? [];
        $this->vocative = $data['vocative'] ?? [];
    }

    public function forCase(\Shevchenko\Language\GrammaticalCase $case): array
    {
        return match ($case) {
            \Shevchenko\Language\GrammaticalCase::NOMINATIVE => $this->nominative,
            \Shevchenko\Language\GrammaticalCase::GENITIVE => $this->genitive,
            \Shevchenko\Language\GrammaticalCase::DATIVE => $this->dative,
            \Shevchenko\Language\GrammaticalCase::ACCUSATIVE => $this->accusative,
            \Shevchenko\Language\GrammaticalCase::ABLATIVE => $this->ablative,
            \Shevchenko\Language\GrammaticalCase::LOCATIVE => $this->locative,
            \Shevchenko\Language\GrammaticalCase::VOCATIVE => $this->vocative,
        };
    }
}