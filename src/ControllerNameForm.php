<?php

declare(strict_types=1);

namespace Lightfoot;

/**
 * ControllerNameForm
 */
class ControllerNameForm implements Controller
{
    /**
     * process
     *
     * @return void
     */
    public function process(): void
    {
        echo new Template('name-form.html.php');
    }
}
