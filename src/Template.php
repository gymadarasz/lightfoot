<?php

declare(strict_types=1);

namespace Lightfoot;

class Template
{
    public const DIR = __DIR__ . '/tpls';

    protected $filename;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function __toString(): string
    {
        ob_start();
        include self::DIR . '/' . $this->filename;
        return ob_get_clean();
    }
}
