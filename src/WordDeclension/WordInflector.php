<?php

declare(strict_types=1);

namespace MedCore\UkrainianAnthroponyms\WordDeclension;

use MedCore\UkrainianAnthroponyms\Language\GrammaticalCase;
use MedCore\UkrainianAnthroponyms\Language\GrammaticalGender;
use MedCore\UkrainianAnthroponyms\Language\WordClass;
use MedCore\UkrainianAnthroponyms\WordDeclension\Enums\ApplicationType;

class WordInflector
{
    /** @var array<DeclensionRule> */
    private readonly array $rules;

    public function __construct(array $rules)
    {
        usort($rules, fn(DeclensionRule $a, DeclensionRule $b) => $b->priority - $a->priority);
        $this->rules = $rules;
    }

    public function inflect(
        string $word,
        GrammaticalCase $grammaticalCase,
        GrammaticalGender $gender,
        ?WordClass $wordClass = null,
        ?ApplicationType $applicationType = null,
    ): string {
        $matchingRules = $this->findMatchingRules($word, $grammaticalCase, $gender, $wordClass, $applicationType);

        if (empty($matchingRules)) {
            return $word;
        }

        $rule = reset($matchingRules);
        return (new DeclensionRuleInflector($rule))->inflect($word, $grammaticalCase);
    }

    /** @return array<DeclensionRule> */
    private function findMatchingRules(
        string $word,
        GrammaticalCase $grammaticalCase,
        GrammaticalGender $gender,
        ?WordClass $wordClass,
        ?ApplicationType $applicationType,
    ): array {
        return array_values(array_filter($this->rules, function (DeclensionRule $rule) use ($word, $gender, $wordClass, $applicationType) {
            // Gender check
            if (!in_array($gender, $rule->gender, true)) {
                return false;
            }

            // Application type check
            if ($applicationType !== null) {
                if (!empty($rule->applicationType)) {
                    $appTypes = array_map(fn($t) => ApplicationType::from($t), $rule->applicationType);
                    if (!in_array($applicationType, $appTypes, true)) {
                        return false;
                    }
                }
            }

            // Pattern check
            $pattern = '/' . $rule->pattern->find . '/iu';
            if (@!preg_match($pattern, $word)) {
                return false;
            }

            // WordClass check
            if ($wordClass !== null && $rule->wordClass !== $wordClass) {
                return false;
            }

            return true;
        }));
    }
}