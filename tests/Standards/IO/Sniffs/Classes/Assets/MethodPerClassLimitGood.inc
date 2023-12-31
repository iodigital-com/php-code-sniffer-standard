<?php

declare(strict_types=1);

namespace MethodPerClassLimitGood;

class MaximumAmountOfMethods
{
    /** @var string */
    protected $foo = 'bar';

    public function method1(): void
    {
    }

    public function method2(): bool
    {
        return true;
    }

    public function method3(): int
    {
        return 1;
    }

    public function method4(): float
    {
        return 1.0;
    }

    public function method5(): string
    {
        return $this->foo;
    }

    /** @return array<int> */
    public function method6(): array
    {
        return [1, 2, 3];
    }

    /** @return null */
    public function method7()
    {
        return null;
    }

    protected function method8(): object
    {
        return new class {
            public function getFoo(): string
            {
                return 'foo';
            }
        };
    }

    private function method9(): void
    {
        function nonClassMethodFunction(): void
        {
        }

        nonClassMethodFunction();
    }

    /**
     * @param mixed $x
     * @return mixed
     */
    //phpcs:ignore Squiz.Scope.MethodScope
    function method10($x)
    {
        return $x;
    }
}
