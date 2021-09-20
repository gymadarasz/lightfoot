<?php

declare(strict_types=1);

namespace Lightfoot;

/**
 * MiddleNameGenerator
 */
interface MiddleNameGenerator
{
    /**
     * generateMiddleName
     *
     * @param string $firstName
     * @param string $lastName
     * @return string
     */
    public function generateMiddleName(string $firstName, string $lastName): string;
}
