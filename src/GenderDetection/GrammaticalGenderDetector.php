<?php

declare(strict_types=1);

namespace MedCore\UkrainianAnthroponyms\GenderDetection;

class GrammaticalGenderDetector
{
    public function __construct(
        private readonly string $masculinePattern,
        private readonly string $femininePattern,
    ) {}

    public function detect(string $name): ?string
    {
        if (preg_match('/(' . $this->masculinePattern . ')$/iu', $name)) {
            return 'masculine';
        }

        if (preg_match('/(' . $this->femininePattern . ')$/iu', $name)) {
            return 'feminine';
        }

        return null;
    }
}