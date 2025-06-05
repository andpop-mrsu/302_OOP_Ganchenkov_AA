<?php

declare(strict_types=1);

namespace App;

class Truncater
{
    private const DEFAULT_OPTIONS = [
        'length' => 50,
        'separator' => '...',
    ];

    private array $options;

    public function __construct(array $options = [])
    {
        $this->options = array_merge(self::DEFAULT_OPTIONS, $options);
    }

    public function truncate(string $text, array $options = []): string
    {
        $currentOptions = array_merge($this->options, $options);

        $length = max(0, $currentOptions['length']);
        $separator = $currentOptions['separator'];

        if (mb_strlen($text) <= $length) {
            return $text;
        }

        return mb_substr($text, 0, $length) . $separator;
    }
}