<?php

declare(strict_types=1);

namespace Lightfoot;

use Exception;

/**
 * TestApp
 */
class TestApp
{
    protected const ROUTES = [
        '' => ControllerNameForm::class,
        'get-name' => ControllerGetName::class,
    ];

    /**
     * Factory
     */
    protected Factory $factory;

    /**
     * InputSanitizer
     */
    protected InputSanitizer $inputSanitizer;

    /**
     * construct
     *
     * @param InputSanitizer $inputSanitizer
     */
    public function __construct(
        Factory $factory,
        InputSanitizer $inputSanitizer
    ) {
        $this->factory = $factory;
        $this->inputSanitizer = $inputSanitizer;
    }

    /**
     * routing
     *
     * @return void
     */
    public function routing(): void
    {
        $q = $this->inputSanitizer->getInputString('q', InputSanitizer::METHOD_GET);
        if (!isset(self::ROUTES[$q])) {
            throw new Exception('Route is not found' . ($q ? ": $q" : ''));
        }
        $ctrlr = self::ROUTES[$q];
        ($this->factory->getInstance($ctrlr))->process();
    }
}
