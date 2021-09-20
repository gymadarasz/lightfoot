<?php

declare(strict_types=1);

namespace Lightfoot;

/**
 * FunMiddleNameGenerator
 */
class FunMiddleNameGenerator implements MiddleNameGenerator
{
    /**
     * generateMiddleName
     *
     * @param string $firstName
     * @param string $lastName
     * @return string
     */
    public function generateMiddleName(string $firstName, string $lastName): string
    {
        $names = preg_split("/\s+/", \file_get_contents(__DIR__ . '/funny-names.txt'));
        return $names[rand(0, count($names)-1)];
    }
}
