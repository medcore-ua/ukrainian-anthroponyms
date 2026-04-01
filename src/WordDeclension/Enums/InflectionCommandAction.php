<?php

declare(strict_types=1);

namespace MedCore\UkrainianAnthroponyms\WordDeclension\Enums;

enum InflectionCommandAction: string
{
    case REPLACE = 'replace';
    case APPEND = 'append';
}