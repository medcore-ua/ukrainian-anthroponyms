<?php

declare(strict_types=1);

namespace Shevchenko\WordDeclension\Enums;

enum ApplicationType: string
{
    case GIVEN_NAME = 'givenName';
    case PATRONYMIC_NAME = 'patronymicName';
    case FAMILY_NAME = 'familyName';
}