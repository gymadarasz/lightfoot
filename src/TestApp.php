<?php

declare(strict_types=1);

namespace Lightfoot;

class TestApp
{
    public function routing(): void
    {
        $q = $_GET['q'];
        switch ($q) {
            
            default:
                throw new Exception('Route is not found' . ($q ? ": $q" : ''));
        }
    }
}
