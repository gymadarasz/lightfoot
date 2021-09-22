<?php

declare(strict_types=1);

namespace Lightfoot;

/**
 * Controller
 */
interface ControllerInterface
{
    /**
     * process
     *
     * @return void
     */
    public function process(): void;
}
