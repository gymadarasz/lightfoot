<?php

declare(strict_types=1);

namespace Lightfoot;

interface MiddleNameGenerator
{
    public function generateMiddleName(string $firstName, string $lastName): string;
}
