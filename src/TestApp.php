<?php

declare(strict_types=1);

namespace Lightfoot;

use Exception;

/**
 * TestApp
 */
class TestApp
{
    /**
     * middleNameGenerator
     */
    protected MiddleNameGenerator $middleNameGenerator;

    /**
     * inputSanitizer
     */
    protected InputSanitizer $inputSanitizer;

    /**
     * construct
     *
     * @param MiddleNameGenerator $middleNameGenerator
     * @param InputSanitizer $inputSanitizer
     */
    public function __construct(
        MiddleNameGenerator $middleNameGenerator,
        InputSanitizer $inputSanitizer
    ) {
        $this->middleNameGenerator = $middleNameGenerator;
        $this->inputSanitizer = $inputSanitizer;
    }

    /**
     * routing
     *
     * @return void
     */
    public function routing(): void
    {
        $q = $this->inputSanitizer->getInputString('q', 'GET');
        switch ($q) {

            case '':
                $this->showForm();
                break;

            case 'get-name':
                $this->showResult();
                break;

            default:
                throw new Exception('Route is not found' . ($q ? ": $q" : ''));
        }
    }

    /**
     * showForm
     *
     * @return void
     */
    protected function showForm(): void
    {
        echo new Template('name-form.html.php');
    }

    /**
     * showResult
     *
     * @return void
     */
    protected function showResult(): void
    {
        $firstName = $this->inputSanitizer->getInputString('first_name', 'POST');
        $lastName = $this->inputSanitizer->getInputString('last_name', 'POST');
        $middleName = $this->middleNameGenerator->generateMiddleName($firstName, $lastName);

        echo (new Template('result-page.html.php'))
            ->add('firstName', $firstName)
            ->add('middleName', $middleName)
            ->add('lastName', $lastName);
    }
}
