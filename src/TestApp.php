<?php

declare(strict_types=1);

namespace Lightfoot;

use Exception;

class TestApp
{
    public function routing(): void
    {
        $q = $_GET['q'] ?? '';
        switch ($q) {
            case '':
                $this->showForm();
                break;
            default:
                throw new Exception('Route is not found' . ($q ? ": $q" : ''));
        }
    }

    protected function showForm(): void
    {
        echo new Template('name-form.html.php');
    }
}
