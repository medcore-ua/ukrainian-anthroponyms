<?php

declare(strict_types=1);

namespace Shevchenko\AnthroponymDeclension;

use Shevchenko\Language\GrammaticalCase;
use Shevchenko\Language\GrammaticalGender;
use Shevchenko\WordDeclension\Enums\ApplicationType;
use Shevchenko\WordDeclension\WordInflector;

class GivenNameInflector extends NameInflector
{
    public function __construct(WordInflector $wordInflector)
    {
        parent::__construct($wordInflector);
    }

    protected function inflectNamePart(
        string $givenName,
        GrammaticalGender $gender,
        GrammaticalCase $grammaticalCase,
        bool $isLastWord = true,
    ): string {
        return $this->wordInflector->inflect(
            $givenName,
            $grammaticalCase,
            $gender,
            applicationType: ApplicationType::GIVEN_NAME,
        );
    }
}