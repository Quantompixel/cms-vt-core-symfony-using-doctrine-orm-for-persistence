<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('quote', [$this, 'formatQuote']),
            new TwigFilter('characterName', [$this, 'formatCharacterName']),
        ];
    }

    public function formatQuote(string $quote): string
    {
        return '"' . $quote . '"';
    }

    public function formatCharacterName(string $characterName): string {
        return '~ ' . $characterName;
    }
}