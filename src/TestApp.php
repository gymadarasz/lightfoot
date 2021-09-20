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
     * InputSanitizer
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
        $q = $this->inputSanitizer->getInputString('q', InputSanitizer::METHOD_GET);
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
        $errors = [];
        $firstName = $this->inputSanitizer->getInputString('first_name', InputSanitizer::METHOD_POST);
        $lastName = $this->inputSanitizer->getInputString('last_name', InputSanitizer::METHOD_POST);
        if (!$firstName) {
            $errors[] = 'First name is required';
        }
        if (!$lastName) {
            $errors[] = 'Last name is required';
        }
        if (!$errors) {
            $tpl = (new Template('result-page.html.php'))
                ->addString('middleName', $this->middleNameGenerator->generateMiddleName($firstName, $lastName));
        } else {
            $tpl = (new Template('name-form.html.php'))
                ->addArray('errors', $errors);
        }
        echo $tpl
            ->addString('firstName', $firstName)
            ->addString('lastName', $lastName);
    }
}
