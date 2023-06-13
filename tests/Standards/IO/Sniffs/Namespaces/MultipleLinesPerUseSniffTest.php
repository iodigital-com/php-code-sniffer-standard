<?php

declare(strict_types=1);

namespace IODigital\CodingStandard\Tests\Standards\IO\Sniffs\Namespaces;

use DateTime;
use IODigital\CodingStandard\Standards\IO\Sniffs\Namespaces\MultipleLinesPerUseSniff;
use IODigital\CodingStandard\Tests\BaseTestCase;
use PHP_CodeSniffer\Exceptions\DeepExitException;

use function implode;
use function sprintf;

class MultipleLinesPerUseSniffTest extends BaseTestCase
{
    /**
     * @return void
     * @throws DeepExitException
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->codeSnifferRunner
            ->setSniff('iO.Namespaces.MultipleLinesPerUse')
            ->setFolder(sprintf('%s/Assets/', __DIR__));
    }

    /**
     * @return void
     * @throws DeepExitException
     */
    public function testSniff(): void
    {
        $results = $this->codeSnifferRunner->sniff('MultipleLinesPerUseSniff.inc');

        self::assertSame(1, $results->getErrorCount(), implode("\n", $results->getAllErrorMessages()));
        self::assertSame(0, $results->getWarningCount());

        $errorMessages = $results->getAllErrorMessages();
        self::assertCount(1, $errorMessages);

        foreach ($errorMessages as $errorMessage) {
            self::assertEquals(sprintf(MultipleLinesPerUseSniff::ERROR_MESSAGE, DateTime::class), $errorMessage);
        }
    }
}
