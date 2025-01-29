<?php

namespace Neo\Grammar\Node\Expr;

class StringLiteral implements Expr
{
    public function __construct(
        public string $value,
    ) {}

    public function children(): array
    {
        return [];
    }
}
