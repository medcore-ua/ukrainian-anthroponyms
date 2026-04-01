<?php

declare(strict_types=1);

namespace Shevchenko\Language;

enum GrammaticalCase: string
{
    case NOMINATIVE = 'nominative';
    case GENITIVE = 'genitive';
    case DATIVE = 'dative';
    case ACCUSATIVE = 'accusative';
    case ABLATIVE = 'ablative';
    case LOCATIVE = 'locative';
    case VOCATIVE = 'vocative';
}