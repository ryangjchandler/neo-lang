<?php

namespace Neo\Grammar;

use RyanChandler\Lexical\Contracts\LexerInterface;
use RyanChandler\Lexical\LexicalBuilder;
use RyanChandler\Lexical\Span;

class Lexer
{
    protected LexerInterface $lexer;

    public function __construct()
    {
        $this->lexer = (new LexicalBuilder)
            ->produceTokenUsing(fn (TokenType $type, string $value, Span $span) => new Token($type, $value, $span))
            ->readTokenTypesFrom(TokenType::class)
            ->build();
    }

    public function tokenize(string $input): TokenStream
    {
        return new TokenStream($this->lexer->tokenise($input));
    }
}
