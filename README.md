# Ukrainian Anthroponyms PHP

A PHP library for declension of Ukrainian anthroponyms (names, patronymics, and surnames) in all 7 grammatical cases.

## Features

- **Grammatical Cases**: Supports all 7 Ukrainian grammatical cases (nominative, genitive, dative, accusative, ablative, locative, vocative).
- **Gender Detection**: Automatic gender detection based on given name and patronymic endings.
- **Multiple Name Types**: Handles given names, patronymics, and family names.
- **Ukrainian Rules**: Built-in declension rules for Ukrainian language patterns.
- **PSR-16 Compatible**: Follows PHP-FIG standards for interoperability.

## Installation

To install the Ukrainian Anthroponyms library, run the following command in your terminal:

```bash
composer require medcore-ua/ukrainian-anthroponyms
```

## Usage

### Basic Setup

```php
use MedCore\UkrainianAnthroponyms\Inflector;
use MedCore\UkrainianAnthroponyms\Contracts\DeclensionInput;
use MedCore\UkrainianAnthroponyms\Language\GrammaticalGender;

$inflector = new Inflector();
```

### Declension in Vocative Case

```php
$input = new DeclensionInput(
    GrammaticalGender::MASCULINE,
    'Тарас',
    'Григорович',
    'Шевченко'
);

$result = $inflector->inVocative($input);

echo $result->givenName;      // Тарасе
echo $result->patronymicName; // Григоровичу
echo $result->familyName;     // Шевченку
```

### Declension in All Cases

```php
$input = new DeclensionInput(
    GrammaticalGender::MASCULINE,
    'Олександр',
    'Сергійович',
    'Коваленко'
);

echo $inflector->inNominative($input)->givenName; // Олександр
echo $inflector->inGenitive($input)->givenName;   // Олександра
echo $inflector->inDative($input)->givenName;     // Олександру
echo $inflector->inAccusative($input)->givenName; // Олександра
echo $inflector->inAblative($input)->givenName;   // Олександром
echo $inflector->inLocative($input)->givenName;   // Олександрові
echo $inflector->inVocative($input)->givenName;   // Олександре
```

### Automatic Gender Detection

```php
$input = new DeclensionInput(
    GrammaticalGender::MASCULINE, // Default gender
    'Тарас',
    null,
    null
);

$detectedGender = $inflector->detectGender($input);
echo $detectedGender->value; // masculine
```

## Contributing

Contributions are welcome and appreciated! Here's how you can contribute:

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

Please make sure to update tests as appropriate and adhere to the existing coding style.

## License

This library is licensed under the CSSM Unlimited License v2.0 (CSSM-ULv2). See the [LICENSE](LICENSE) file for details.
