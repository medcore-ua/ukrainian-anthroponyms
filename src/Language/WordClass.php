<?php

declare(strict_types=1);

namespace Shevchenko\Language;

enum WordClass: string
{
    case NOUN = 'noun';
    case ADJECTIVE = 'adjective';
}