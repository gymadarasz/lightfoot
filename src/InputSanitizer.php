<?php

declare(strict_types=1);

namespace Lightfoot;

use Exception;

/**
 * InputSanitizer
 */
class InputSanitizer
{
    /**
     * getInputString
     *
     * @param string $key
     * @param string $from
     * @return string
     */
    public function getInputString(string $key, string $from): string
    {
        switch ($from) {
            case 'GET':
                $value = $_GET[$key] ?? '';
                break;
            case 'POST':
                $value = $_POST[$key] ?? '';
                break;
            default:
                throw new Exception('Invalid input method' . ($from ? ": $from" : ''));
        }
        return htmlentities($value, ENT_QUOTES, 'UTF-8');
    }
}
