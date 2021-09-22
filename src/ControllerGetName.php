<?php

declare(strict_types=1);

namespace Lightfoot;

/**
 * ControllerGetName
 */
class ControllerGetName implements ControllerInterface
{
    /**
     * InputSanitizer
     */
    protected InputSanitizer $inputSanitizer;

    /**
     * middleNameGeneratorInterface
     */
    protected MiddleNameGeneratorInterface $middleNameGenerator;

    /**
     * construct
     *
     * @param InputSanitizer $inputSanitizer
     * @param MiddleNameGeneratorInterface $middleNameGenerator
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
        $firstName = ucfirst($this->inputSanitizer->getInputString('first_name', InputSanitizer::METHOD_POST));
        $lastName = ucfirst($this->inputSanitizer->getInputString('last_name', InputSanitizer::METHOD_POST));
        if (!$firstName) {
            $errors[] = 'First name is required';
        }
        if (!$lastName) {
            $errors[] = 'Last name is required';
        }

        $tpl = $errors ?
            (new Template('name-form.html.php'))
                ->addArray('errors', $errors) :
            (new Template('result-page.html.php'))
                ->addString('middleName', $this->middleNameGenerator->generateMiddleName($firstName, $lastName));

        echo $tpl
            ->addString('firstName', $firstName)
            ->addString('lastName', $lastName);
    }
}
