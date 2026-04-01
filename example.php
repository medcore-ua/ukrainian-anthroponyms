<?php

require_once __DIR__ . '/vendor/autoload.php';

use MedCore\UkrainianAnthroponyms\Inflector;
use MedCore\UkrainianAnthroponyms\Contracts\DeclensionInput;
use MedCore\UkrainianAnthroponyms\Language\GrammaticalGender;

$inflector = new Inflector();

echo "=== Auto Gender Detection ===\n";
$input1 = new DeclensionInput(
    GrammaticalGender::MASCULINE,
    'Тарас',
    'Григорович',
    'Шевченко'
);
$result1 = $inflector->inVocative($input1);
echo "Input: Тарас Григорович Шевченко\n";
echo "Vocative: {$result1->givenName} {$result1->patronymicName} {$result1->familyName}\n";

echo "\n=== Automatic gender detection ===\n";
$input2 = new DeclensionInput(
    GrammaticalGender::FEMININE,
    'Лариса',
    'Петрівна',
    'Косач-Квітка'
);
$result2 = $inflector->inVocative($input2);
echo "Input: Лариса Петрівна Косач-Квітка\n";
echo "Vocative: {$result2->givenName} {$result2->patronymicName} {$result2->familyName}\n";

echo "\n=== Detect gender ===\n";
$genderInput = new DeclensionInput(
    GrammaticalGender::MASCULINE,
    'Тарас',
    null,
    null
);
$detectedGender = $inflector->detectGender($genderInput);
echo "Detected gender for Тарас: " . ($detectedGender?->value ?? 'unknown') . "\n";

$genderInput2 = new DeclensionInput(
    GrammaticalGender::MASCULINE,
    'Лариса',
    null,
    null
);
$detectedGender2 = $inflector->detectGender($genderInput2);
echo "Detected gender for Лариса: " . ($detectedGender2?->value ?? 'unknown') . "\n";

echo "\n=== Other cases ===\n";
$input = new DeclensionInput(GrammaticalGender::MASCULINE, 'Олександр', 'Сергійович', 'Коваленko');
echo "Nominative: " . $inflector->inNominative($input)->givenName . "\n";
echo "Genitive: " . $inflector->inGenitive($input)->givenName . "\n";
echo "Dative: " . $inflector->inDative($input)->givenName . "\n";
echo "Accusative: " . $inflector->inAccusative($input)->givenName . "\n";
echo "Ablative: " . $inflector->inAblative($input)->givenName . "\n";
echo "Locative: " . $inflector->inLocative($input)->givenName . "\n";
echo "Vocative: " . $inflector->inVocative($input)->givenName . "\n";