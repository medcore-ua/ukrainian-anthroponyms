<?php

declare(strict_types=1);

namespace MedCore\UkrainianAnthroponyms\GenderDetection;

use MedCore\UkrainianAnthroponyms\Contracts\DeclensionInputInterface;
use MedCore\UkrainianAnthroponyms\Language\GrammaticalGender;

class GenderDetector
{
    private readonly GrammaticalGenderDetector $givenNameDetector;
    private readonly GrammaticalGenderDetector $patronymicNameDetector;

    public function __construct()
    {
        $givenContent = file_get_contents(__DIR__ . '/../../rules/given-name-rules.json');
        if (! is_string($givenContent)) {
            throw new \RuntimeException('Failed to read given-name-rules.json');
        }
        $givenNameRules = json_decode($givenContent, true, 512, JSON_THROW_ON_ERROR);

        $patronymicContent = file_get_contents(__DIR__ . '/../../rules/patronymic-name-rules.json');
        if (! is_string($patronymicContent)) {
            throw new \RuntimeException('Failed to read patronymic-name-rules.json');
        }
        $patronymicNameRules = json_decode($patronymicContent, true, 512, JSON_THROW_ON_ERROR);

        $this->givenNameDetector = new GrammaticalGenderDetector(
            is_array($givenNameRules) && isset($givenNameRules['masculine']) && is_string($givenNameRules['masculine']) ? $givenNameRules['masculine'] : '',
            is_array($givenNameRules) && isset($givenNameRules['feminine']) && is_string($givenNameRules['feminine']) ? $givenNameRules['feminine'] : '',
        );

        $this->patronymicNameDetector = new GrammaticalGenderDetector(
            is_array($patronymicNameRules) && isset($patronymicNameRules['masculine']) && is_string($patronymicNameRules['masculine']) ? $patronymicNameRules['masculine'] : '',
            is_array($patronymicNameRules) && isset($patronymicNameRules['feminine']) && is_string($patronymicNameRules['feminine']) ? $patronymicNameRules['feminine'] : '',
        );
    }

    public function detect(DeclensionInputInterface $input) : ?GrammaticalGender
    {
        $patronymic = $input->getPatronymicName();
        if (null !== $patronymic) {
            $result = $this->patronymicNameDetector->detect(mb_strtolower($patronymic, 'UTF-8'));
            if (null !== $result) {
                return GrammaticalGender::from($result);
            }
        }

        $given = $input->getGivenName();
        if (null !== $given) {
            $result = $this->givenNameDetector->detect(mb_strtolower($given, 'UTF-8'));
            if (null !== $result) {
                return GrammaticalGender::from($result);
            }
        }

        return null;
    }
}