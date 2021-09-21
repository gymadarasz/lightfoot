<?php

declare(strict_types=1);

namespace Lightfoot;

include_once __DIR__ . '/vendor/autoload.php';

(new Factory())->getInstance(TestApp::class)->routing();
