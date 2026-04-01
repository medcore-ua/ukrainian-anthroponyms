<?php

require_once __DIR__ . '/vendor/autoload.php';

use Shevchenko\Shevchenko;
use Shevchenko\Contracts\DeclensionInput;
use Shevchenko\Language\GrammaticalGender;

$shevchenko = new Shevchenko();

echo "=== Auto Gender Detection ===\n";
$input1 = new DeclensionInput(
    GrammaticalGender::MASCULINE,
    'Тарас',
    'Григорович',
    'Шевченко'
);
$result1 = $shevchenko->inVocative($input1);
echo "Input: Тарас Григорович Шевченко\n";
echo "Vocative: {$result1->givenName} {$result1->patronymicName} {$result1->familyName}\n";

echo "\n=== Automatic gender detection ===\n";
$input2 = new DeclensionInput(
    GrammaticalGender::FEMININE,
    'Лариса',
    'Петрівна',
    'Косач-Квітка'
);
$result2 = $shevchenko->inVocative($input2);
echo "Input: Лариса Петрівна Косач-Квітка\n";
echo "Vocative: {$result2->givenName} {$result2->patronymicName} {$result2->familyName}\n";

echo "\n=== Detect gender ===\n";
$genderInput = new DeclensionInput(
    GrammaticalGender::MASCULINE,
    'Тарас',
    null,
    null
);
$detectedGender = $shevchenko->detectGender($genderInput);
echo "Detected gender for Тарас: " . ($detectedGender?->value ?? 'unknown') . "\n";

$genderInput2 = new DeclensionInput(
    GrammaticalGender::MASCULINE,
    'Лариса',
    null,
    null
);
$detectedGender2 = $shevchenko->detectGender($genderInput2);
echo "Detected gender for Лариса: " . ($detectedGender2?->value ?? 'unknown') . "\n";

echo "\n=== Other cases ===\n";
$input = new DeclensionInput(GrammaticalGender::MASCULINE, 'Олександр', 'Сергійович', 'Коваленко');
echo "Nominative: " . $shevchenko->inNominative($input)->givenName . "\n";
echo "Genitive: " . $shevchenko->inGenitive($input)->givenName . "\n";
echo "Dative: " . $shevchenko->inDative($input)->givenName . "\n";
echo "Accusative: " . $shevchenko->inAccusative($input)->givenName . "\n";
echo "Ablative: " . $shevchenko->inAblative($input)->givenName . "\n";
echo "Locative: " . $shevchenko->inLocative($input)->givenName . "\n";
echo "Vocative: " . $shevchenko->inVocative($input)->givenName . "\n";