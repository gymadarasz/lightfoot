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
        switch ($from) {

            case self::METHOD_GET:
                $value = $_GET[$key] ?? '';
                break;

            case self::METHOD_POST:
                $value = $_POST[$key] ?? '';
                break;

            default:
                throw new Exception('Invalid input method' . ($from ? ": $from" : ''));
        }
        return htmlentities($value, ENT_QUOTES, 'UTF-8');
    }
}
