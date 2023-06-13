<?php

declare(strict_types=1);

namespace IODigital\CodingStandard\Tests\Standards\IO\Sniffs\ControlStructures;

use IODigital\CodingStandard\Standards\IO\Sniffs\ControlStructures\DisallowNullCoalesceOperatorSniff;
use IODigital\CodingStandard\Tests\BaseTestCase;
use PHP_CodeSniffer\Exceptions\DeepExitException;

use function sprintf;

class DisallowNullCoalesceOperatorSniffTest extends BaseTestCase
{
    /**
     * @return void
     * @throws DeepExitException
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->codeSnifferRunner
            ->setSniff('iO.ControlStructures.DisallowNullCoalesceOperator')
            ->setFolder(sprintf('%s/Assets/', __DIR__));
    }

    /**
     * @return void
     * @throws DeepExitException
     */
    public function testSniff(): void
    {
        $results = $this->codeSnifferRunner->sniff('DisallowNullCoalesceOperatorSniff.inc');

        self::assertSame(1, $results->getErrorCount());
        self::assertSame(0, $results->getWarningCount());

        $errorMessages = $results->getAllErrorMessages();
        self::assertCount(1, $errorMessages);

        foreach ($errorMessages as $errorMessage) {
            self::assertEquals(DisallowNullCoalesceOperatorSniff::ERROR_MESSAGE, $errorMessage);
        }
    }
}
