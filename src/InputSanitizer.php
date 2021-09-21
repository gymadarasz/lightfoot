<?php

declare(strict_types=1);

namespace Lightfoot;

use Exception;

/**
 * InputSanitizer
 */
class InputSanitizer
{
    public const METHOD_POST = 'POST';
    public const METHOD_GET = 'GET';

    /**
     * params
     */
    protected array $params;

    /**
     * construct
     */
    public function __construct()
    {
        $this->params = [
            self::METHOD_GET => $_GET,
            self::METHOD_POST => $_POST,
        ];
    }

    /**
     * getInputString
     *
     * @param string $key
     * @param string $from
     * @return string
     */
    public function getInputString(string $key, string $from): string
    {
        if (!$key) {
            throw new Exception('Missing input parameter');
        }

        if (!isset($this->params[$from])) {
            throw new Exception('Invalid input method' . ($from ? ": $from" : '') . ($key ? ", key: $key" : ''));
        }

        return htmlentities($this->params[$from][$key] ?? '', ENT_QUOTES, 'UTF-8');
    }
}
