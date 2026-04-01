<?php

declare(strict_types=1);

namespace Shevchenko\GenderDetection;

use Shevchenko\Contracts\DeclensionInputInterface;
use Shevchenko\Language\GrammaticalGender;

class GenderDetector
{
    private readonly GrammaticalGenderDetector $givenNameDetector;
    private readonly GrammaticalGenderDetector $patronymicNameDetector;

    public function __construct()
    {
        $givenNameRules = json_decode(file_get_contents(__DIR__ . '/../../rules/given-name-rules.json'), true);
        $patronymicNameRules = json_decode(file_get_contents(__DIR__ . '/../../rules/patronymic-name-rules.json'), true);

        $this->givenNameDetector = new GrammaticalGenderDetector(
            $givenNameRules['masculine'],
            $givenNameRules['feminine'],
        );

        $this->patronymicNameDetector = new GrammaticalGenderDetector(
            $patronymicNameRules['masculine'],
            $patronymicNameRules['feminine'],
        );
    }

    public function detect(DeclensionInputInterface $input): ?GrammaticalGender
    {
        if ($input->getPatronymicName() !== null) {
            $result = $this->patronymicNameDetector->detect(mb_strtolower($input->getPatronymicName(), 'UTF-8'));
            if ($result !== null) {
                return GrammaticalGender::from($result);
            }
        }

        if ($input->getGivenName() !== null) {
            $result = $this->givenNameDetector->detect(mb_strtolower($input->getGivenName(), 'UTF-8'));
            if ($result !== null) {
                return GrammaticalGender::from($result);
            }
        }

        return null;
    }
}