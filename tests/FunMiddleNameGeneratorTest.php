<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Lightfoot\FunMiddleNameGenerator;

/**
 * FunMiddleNameGeneratorTest
 */
final class FunMiddleNameGeneratorTest extends TestCase
{
    /**
     * startWith
     *
     * @param string $string
     * @param string $firstChar
     * @return bool
     */
    protected function startWith(string $string, string $firstChar): bool
    {
        return ($string[0] ?? '') === $firstChar;
    }

    /**
     * testFunnyNames
     *
     * @return void
     */
    public function testFunnyNames(): void {
        $letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        $names = preg_split("/\s+/", \file_get_contents(__DIR__ . '/../src/funny-names.txt'));
        $founds = [];
        foreach ($names as $name) {
            $this->assertMatchesRegularExpression('/^[A-Z\'][A-Za-z\-\']+$/', $name, 'Each name should be valid');
            if (in_array($name[0] ?? '', $letters)) {
                array_push($founds, $name[0]);
            }
        }
        $founds = array_unique($founds);
        sort($founds);
        $this->assertEquals($letters, $founds, 'We should have names starting with each possible letters.');
    }

    /**
     * testGenerateMiddleName
     *
     * @return void
     */
    public function testGenerateMiddleName(): void
    {
        $funMiddleNameGenerator = new FunMiddleNameGenerator();
        $middleName = $funMiddleNameGenerator->generateMiddleName('John', 'Smith');
        $this->assertTrue(
            $this->startWith($middleName, 'J') || $this->startWith($middleName, 'S'),
            'Middle name should start with the first letter from any of first or last name,
            and also should always give a non-empty (or white) results, even if it did not find any matches'
        );
        
        $middleName = $funMiddleNameGenerator->generateMiddleName('123John', '!@#Smith');
        $this->assertNotEmpty(
            trim($middleName),
            'Middle name generator should always give a non-empty (or white) results, even if it did not find any matches'
        );
    }
}
