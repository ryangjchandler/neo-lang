<?php

namespace Neo\Grammar;

use Exception;

class UnexpectedTokenException extends Exception
{
    public function __construct(
        protected Token $token,
    ) {
        parent::__construct("Unexpected token: {$token->value}");
    }
}
