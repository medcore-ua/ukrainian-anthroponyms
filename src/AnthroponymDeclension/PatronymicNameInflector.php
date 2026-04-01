<?php

declare(strict_types=1);

namespace Shevchenko\AnthroponymDeclension;

use Shevchenko\Language\GrammaticalCase;
use Shevchenko\Language\GrammaticalGender;
use Shevchenko\WordDeclension\Enums\ApplicationType;
use Shevchenko\WordDeclension\WordInflector;

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