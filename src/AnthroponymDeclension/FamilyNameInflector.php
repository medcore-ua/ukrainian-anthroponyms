<?php

declare(strict_types=1);

namespace MedCore\UkrainianAnthroponyms\AnthroponymDeclension;

use MedCore\UkrainianAnthroponyms\Language\GrammaticalCase;
use MedCore\UkrainianAnthroponyms\Language\GrammaticalGender;
use MedCore\UkrainianAnthroponyms\Language\Linguistics;
use MedCore\UkrainianAnthroponyms\Language\WordClass;
use MedCore\UkrainianAnthroponyms\WordDeclension\Enums\ApplicationType;
use MedCore\UkrainianAnthroponyms\WordDeclension\WordInflector;

class FamilyNameInflector extends NameInflector
{
    private const UNCERTAIN_FEMININE_PATTERN = '/[ая]$/iu';
    private const UNCERTAIN_MASCULINE_PATTERN = '/(ой|ий|ій|их)$/iu';

    public function __construct(WordInflector $wordInflector)
    {
        parent::__construct($wordInflector);
    }

    protected function inflectNamePart(
        string $familyName,
        GrammaticalGender $gender,
        GrammaticalCase $grammaticalCase,
        bool $isLastWord = true,
    ): string {
        if (!$isLastWord && Linguistics::isMonosyllable($familyName)) {
            return $familyName;
        }

        $wordClass = $this->determineWordClass($familyName, $gender);

        return $this->wordInflector->inflect(
            $familyName,
            $grammaticalCase,
            $gender,
            wordClass: $wordClass,
            applicationType: ApplicationType::FAMILY_NAME,
        );
    }

    private function determineWordClass(string $familyName, GrammaticalGender $gender): WordClass
    {
        if ($gender === GrammaticalGender::FEMININE && preg_match(self::UNCERTAIN_FEMININE_PATTERN, $familyName)) {
            return WordClass::ADJECTIVE;
        }

        if ($gender === GrammaticalGender::MASCULINE && preg_match(self::UNCERTAIN_MASCULINE_PATTERN, $familyName)) {
            return WordClass::ADJECTIVE;
        }

        return WordClass::NOUN;
    }
}