<?php

namespace Neo\Grammar\Node;

class Echo_ implements Node
{
    /**
     * @param Expr\Expr[] $values
     */
    public function __construct(
        public array $values,
    ) {}

    public function children(): array
    {
        return [];
    }
}
