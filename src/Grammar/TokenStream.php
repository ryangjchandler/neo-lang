<?php

namespace Neo\Grammar;

class TokenStream
{
    protected int $i = 0;

    protected int $length;

    /**
     * @param  Token[]  $tokens
     */
    public function __construct(
        protected array $tokens,
    ) {
        $this->length = count($tokens);
    }

    public function isEof(): bool
    {
        return $this->i >= $this->length;
    }

    public function current(): Token
    {
        return $this->tokens[$this->i];
    }

    public function peek(): ?Token
    {
        return $this->tokens[$this->i + 1] ?? null;
    }

    public function next(): void
    {
        $this->i++;
    }

    public function is(TokenType ...$types): bool
    {
        return in_array($this->current()->type, $types, true);
    }

    public function expect(TokenType $type): Token
    {
        if (! $this->is($type)) {
            throw new UnexpectedTokenException($this->current(), $type);
        }

        $token = $this->current();

        $this->next();

        return $token;
    }
}
