<?php

declare(strict_types=1);

namespace Lightfoot;

/**
 * FunMiddleNameGenerator
 */
class FunMiddleNameGenerator implements MiddleNameGeneratorInterface
{
    public const FUNNY_NAMES_FILE = __DIR__ . '/funny-names.txt';

    /**
     * getFunnyNames
     *
     * @return string[]
     */
    protected function getFunnyNames(): array
    {
        return preg_split("/\s+/", \file_get_contents(self::FUNNY_NAMES_FILE));
    }

    /**
     * getRandomName
     *
     * @param string[] $names
     * @return string
     */
    protected function getRandomName(array $names): string
    {
        return $names[rand(0, count($names)-1)];
    }

    /**
     * getStringFirstCharacter
     *
     * @param string $string
     * @return string
     */
    protected function getStringFirstCharacter(string $string): string
    {
        return $string[0];
    }

    /**
     * isNameMatchesToFirstOrLastNameStart
     *
     * @param string $name
     * @param string $firstName
     * @param string $lastName
     * @return bool
     */
    protected function isNameMatchesToFirstOrLastNameStart(string $name, string $firstName, string $lastName): bool
    {
        return
            $this->getStringFirstCharacter($name) === $this->getStringFirstCharacter($firstName) ||
            $this->getStringFirstCharacter($name) === $this->getStringFirstCharacter($lastName);
    }

    /**
     * generateMiddleName
     *
     * @param string $firstName
     * @param string $lastName
     * @return string
     */
    public function generateMiddleName(string $firstName, string $lastName): string
    {
        $names = $this->getFunnyNames();
        $i = 100;
        $name = ' ';
        while ($i && !$this->isNameMatchesToFirstOrLastNameStart($name, $firstName, $lastName)) {
            $name = $this->getRandomName($names);
            $i--;
        }

        return $name;
    }
}
