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
        $i = 10;
        $name = ' ';
        while ($i && $name[0] !== $firstName[0] && $name[0] !== $lastName[0]) {
            $name = $names[rand(0, count($names)-1)];
            $i--;
        }
        return $name;
    }
}
