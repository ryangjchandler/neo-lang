<?php

namespace Neo\Grammar;

use RyanChandler\Lexical\Span;

readonly class Token
{
    public function __construct(
        public TokenType $type,
        public string $value,
        public Span $span,
    ) {}
}
