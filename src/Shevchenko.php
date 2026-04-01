<?php

declare(strict_types=1);

namespace Shevchenko;

use Shevchenko\AnthroponymDeclension\FamilyNameInflector;
use Shevchenko\AnthroponymDeclension\GivenNameInflector;
use Shevchenko\AnthroponymDeclension\PatronymicNameInflector;
use Shevchenko\Contracts\DeclensionInput;
use Shevchenko\Contracts\DeclensionInputInterface;
use Shevchenko\Contracts\DeclensionOutput;
use Shevchenko\GenderDetection\GenderDetector;
use Shevchenko\Language\GrammaticalCase;
use Shevchenko\Language\GrammaticalGender;
use Shevchenko\WordDeclension\DeclensionRuleLoader;
use Shevchenko\WordDeclension\WordInflector;

class Shevchenko
{
    private readonly GivenNameInflector $givenNameInflector;
    private readonly PatronymicNameInflector $patronymicNameInflector;
    private readonly FamilyNameInflector $familyNameInflector;
    private readonly GenderDetector $genderDetector;

    public function __construct()
    {
        $rules = DeclensionRuleLoader::loadFromFile(__DIR__ . '/../rules/declension-rules.json');
        $wordInflector = new WordInflector($rules);

        $this->givenNameInflector = new GivenNameInflector($wordInflector);
        $this->patronymicNameInflector = new PatronymicNameInflector($wordInflector);
        $this->familyNameInflector = new FamilyNameInflector($wordInflector);
        $this->genderDetector = new GenderDetector();
    }

    public function inNominative(DeclensionInputInterface $input): DeclensionOutput
    {
        return $this->inflect($input, GrammaticalCase::NOMINATIVE);
    }

    public function inGenitive(DeclensionInputInterface $input): DeclensionOutput
    {
        return $this->inflect($input, GrammaticalCase::GENITIVE);
    }

    public function inDative(DeclensionInputInterface $input): DeclensionOutput
    {
        return $this->inflect($input, GrammaticalCase::DATIVE);
    }

    public function inAccusative(DeclensionInputInterface $input): DeclensionOutput
    {
        return $this->inflect($input, GrammaticalCase::ACCUSATIVE);
    }

    public function inAblative(DeclensionInputInterface $input): DeclensionOutput
    {
        return $this->inflect($input, GrammaticalCase::ABLATIVE);
    }

    public function inLocative(DeclensionInputInterface $input): DeclensionOutput
    {
        return $this->inflect($input, GrammaticalCase::LOCATIVE);
    }

    public function inVocative(DeclensionInputInterface $input): DeclensionOutput
    {
        return $this->inflect($input, GrammaticalCase::VOCATIVE);
    }

    public function detectGender(DeclensionInputInterface $input): ?GrammaticalGender
    {
        return $this->genderDetector->detect($input);
    }

    private function inflect(DeclensionInputInterface $input, GrammaticalCase $case): DeclensionOutput
    {
        $gender = $input->getGender();

        return new DeclensionOutput(
            givenName: $this->givenNameInflector->inflect(
                $input->getGivenName(),
                $gender,
                $case,
            ),
            patronymicName: $this->patronymicNameInflector->inflect(
                $input->getPatronymicName(),
                $gender,
                $case,
            ),
            familyName: $this->familyNameInflector->inflect(
                $input->getFamilyName(),
                $gender,
                $case,
            ),
        );
    }
}