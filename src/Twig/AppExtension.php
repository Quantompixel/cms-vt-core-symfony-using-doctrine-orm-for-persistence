<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Twig\TwigTest;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('quote', [$this, 'formatQuote']),
            new TwigFilter('characterName', [$this, 'formatCharacterName']),
        ];
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('year', [$this, 'calculateYears'])
        ];
    }

    public function getTests()
    {
        return [
            new TwigTest('wizany', [$this, 'isMarkus'])
        ];
    }

    public function isMarkus(string $value): bool
    {
        return $value === 'Markus Wizany';
    }

    public function calculateYears(int $year)
    {
        $timespan = getdate(time())['year'] - $year;

        if ($timespan === 0) {
            return 'this year';
        }

        return $timespan . ' years ago';
    }

    public function formatQuote(string $quote): string
    {
        return '"' . $quote . '"';
    }

    public function formatCharacterName(string $characterName): string {
        return '~ ' . $characterName;
    }
}