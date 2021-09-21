<?php

declare(strict_types=1);

namespace Lightfoot;

/**
 * Controller
 */
interface Controller
{
    /**
     * process
     *
     * @return void
     */
    public function process(): void;
}
