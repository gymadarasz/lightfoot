<?php

declare(strict_types=1);

namespace Lightfoot;

/**
 * Template
 */
class Template
{
    public const DIR = __DIR__ . '/tpls';

    /**
     * filename
     */
    protected string $filename;

    /**
     * data
     */
    protected array $data;

    /**
     * construct
     *
     * @param string $filename
     * @param array $data
     */
    public function __construct(string $filename, array $data = [])
    {
        $this->filename = $filename;
        $this->data = $data;
    }

    /**
     * addString
     *
     * @param string $key
     * @param string $value
     * @return self
     */
    public function addString(string $key, string $value): self
    {
        $this->data[$key] = $value;
        return $this;
    }

    /**
     * addArray
     *
     * @param string $key
     * @param array $value
     * @return self
     */
    public function addArray(string $key, array $value): self
    {
        $this->data[$key] = $value;
        return $this;
    }

    /**
     * toString
     *
     * @return string
     */
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
