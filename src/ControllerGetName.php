<?php

declare(strict_types=1);

namespace Lightfoot;

/**
 * ControllerGetName
 */
class ControllerGetName implements Controller
{
    /**
     * InputSanitizer
     */
    protected InputSanitizer $inputSanitizer;

    /**
     * middleNameGenerator
     */
    protected MiddleNameGenerator $middleNameGenerator;

    /**
     * construct
     *
     * @param InputSanitizer $inputSanitizer
     * @param MiddleNameGenerator $middleNameGenerator
     */
    public function __construct(
        InputSanitizer $inputSanitizer,
        FunMiddleNameGenerator $middleNameGenerator
    ) {
        $this->inputSanitizer = $inputSanitizer;
        $this->middleNameGenerator = $middleNameGenerator;
    }

    /**
     * process
     *
     * @return void
     */
    public function process(): void
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
