<?php

declare(strict_types=1);

namespace MedCore\UkrainianAnthroponyms\WordDeclension;

use MedCore\UkrainianAnthroponyms\Language\GrammaticalCase;
use MedCore\UkrainianAnthroponyms\Language\LetterCase;
use MedCore\UkrainianAnthroponyms\WordDeclension\Enums\InflectionCommandAction;

class DeclensionRuleInflector
{
    public function __construct(
        private readonly DeclensionRule $rule,
    ) {}

    public function inflect(string $word, GrammaticalCase $grammaticalCase): string
    {
        $commandsArray = $this->rule->grammaticalCases->forCase($grammaticalCase);

        if (empty($commandsArray) || !isset($commandsArray[0])) {
            return $word;
        }

        $commands = $commandsArray[0];
        if (empty($commands)) {
            return $word;
        }

        $modify = $this->rule->pattern->modify;
        $searchPattern = '/' . $modify . '/iu';
        
        $inflectedWord = preg_replace_callback($searchPattern, function (array $matches) use ($commands): string {
            $replacer = '';
            $groupCount = count($matches) - 1;
            
            for ($groupIndex = 0; $groupIndex < $groupCount; $groupIndex++) {
                $value = $matches[$groupIndex + 1] ?? '';
                
                $commandKey = (string) $groupIndex;
                $debugKey = $commandKey;
                
                // Try both string and int keys
                $commandData = null;
                if (isset($commands[$debugKey])) {
                    $commandData = $commands[$debugKey];
                } elseif (isset($commands[$groupIndex])) {
                    $commandData = $commands[$groupIndex];
                }
                
                if ($commandData !== null && isset($commandData['action']) && isset($commandData['value'])) {
                    $command = new InflectionCommand(
                        InflectionCommandAction::from($commandData['action']),
                        $commandData['value']
                    );
                    
                    $runner = match ($command->action) {
                        InflectionCommandAction::REPLACE => new ReplaceCommandRunner($command),
                        InflectionCommandAction::APPEND => new AppendCommandRunner($command),
                    };
                    
                    $value = $runner->exec($value);
                }
                
                $replacer .= $value;
            }
            
            return $replacer;
        }, $word);

        return LetterCase::copyLetterCase($word, $inflectedWord ?? $word);
    }
}