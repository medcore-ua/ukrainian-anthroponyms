<?php

declare(strict_types=1);

namespace MedCore\UkrainianAnthroponyms\WordDeclension;

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

    public function forCase(\MedCore\UkrainianAnthroponyms\Language\GrammaticalCase $case): array
    {
        return match ($case) {
            \MedCore\UkrainianAnthroponyms\Language\GrammaticalCase::NOMINATIVE => $this->nominative,
            \MedCore\UkrainianAnthroponyms\Language\GrammaticalCase::GENITIVE => $this->genitive,
            \MedCore\UkrainianAnthroponyms\Language\GrammaticalCase::DATIVE => $this->dative,
            \MedCore\UkrainianAnthroponyms\Language\GrammaticalCase::ACCUSATIVE => $this->accusative,
            \MedCore\UkrainianAnthroponyms\Language\GrammaticalCase::ABLATIVE => $this->ablative,
            \MedCore\UkrainianAnthroponyms\Language\GrammaticalCase::LOCATIVE => $this->locative,
            \MedCore\UkrainianAnthroponyms\Language\GrammaticalCase::VOCATIVE => $this->vocative,
        };
    }
}