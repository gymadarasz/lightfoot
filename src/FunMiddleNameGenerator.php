<?php

declare(strict_types=1);

namespace Lightfoot;

class FunMiddleNameGenerator implements MiddleNameGenerator
{
    public function generateMiddleName(string $firstName, string $lastName): string
    {
        return 'Blah..'; // TODO: do dome fun
    }
}
