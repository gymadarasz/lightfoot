<?php

declare(strict_types=1);

namespace Lightfoot;

include_once __DIR__ . '/vendor/autoload.php';

(new TestApp(
    new FunMiddleNameGenerator(),
    new InputSanitizer()
))->routing();
