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
        return 'Blah..'; // TODO: do some fun
    }
}
