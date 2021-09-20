<?php

declare(strict_types=1);

namespace Lightfoot;

class Template
{
    public const DIR = __DIR__ . '/tpls';

    protected $filename;
    protected $data;

    public function __construct(string $filename, array $data = [])
    {
        $this->filename = $filename;
        $this->data = $data;
    }

    public function add(string $key, string $value): self
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function __toString(): string
    {
        foreach ($this->data as $__key => $__value) {
            $$__key = $__value;
        }
        unset($__key);
        unset($__value);
        ob_start();
        include self::DIR . '/' . $this->filename;
        return ob_get_clean();
    }
}
