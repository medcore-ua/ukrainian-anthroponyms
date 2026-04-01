<?php

declare(strict_types=1);

namespace MedCore\UkrainianAnthroponyms\AnthroponymDeclension;

use MedCore\UkrainianAnthroponyms\Language\GrammaticalCase;
use MedCore\UkrainianAnthroponyms\Language\GrammaticalGender;
use MedCore\UkrainianAnthroponyms\WordDeclension\Enums\ApplicationType;
use MedCore\UkrainianAnthroponyms\WordDeclension\WordInflector;

class PatronymicNameInflector extends NameInflector
{
    public function __construct(WordInflector $wordInflector)
    {
        parent::__construct($wordInflector);
    }

    protected function inflectNamePart(
        string $patronymicName,
        GrammaticalGender $gender,
        GrammaticalCase $grammaticalCase,
        bool $isLastWord = true,
    ): string {
        return $this->wordInflector->inflect(
            $patronymicName,
            $grammaticalCase,
            $gender,
            applicationType: ApplicationType::PATRONYMIC_NAME,
        );
    }
}