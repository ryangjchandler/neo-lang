<?php

namespace Neo\Grammar;

use Neo\Grammar\Node\Echo_;
use Neo\Grammar\Node\Expr\Expr;
use Neo\Grammar\Node\Expr\StringLiteral;
use Neo\Grammar\Node\Fn_;
use Neo\Grammar\Node\Node;
use Neo\Grammar\Node\Type\StringType;
use Neo\Grammar\Node\Type\Type;

class Parser
{
    public function parse(TokenStream $tokens): array
    {
        $state = new ParserState;

        while (! $tokens->isEof()) {
            $this->topLevelNode($state, $tokens);
        }

        return $state->nodes;
    }

    protected function topLevelNode(ParserState $state, TokenStream $tokens): void
    {
        match ($tokens->current()->type) {
            TokenType::Fn => $this->fn($state, $tokens),
        };
    }

    protected function node(TokenStream $tokens): Node
    {
        return match ($tokens->current()->type) {
            TokenType::Echo => $this->echo($tokens),
        };
    }

    protected function echo(TokenStream $tokens): Echo_
    {
        $tokens->expect(TokenType::Echo);
        
        $values = [];

        while (! $tokens->is(TokenType::SemiColon)) {
            $this->assertNotEof($tokens);

            $values[] = $this->expr($tokens);

            if ($tokens->is(TokenType::Comma)) {
                $tokens->next();
            }
        }

        $tokens->expect(TokenType::SemiColon);

        return new Echo_($values);
    }

    protected function fn(ParserState $state, TokenStream $tokens): void
    {
        $tokens->expect(TokenType::Fn);
        
        $name = $tokens->expect(TokenType::Identifier)->value;
        $parameters = [];

        $tokens->expect(TokenType::LeftParen);
        $tokens->expect(TokenType::RightParen);

        $returnType = null;

        if ($tokens->is(TokenType::Colon)) {
            $tokens->next();

            $returnType = $this->type($tokens);
        }

        $body = [];

        $tokens->expect(TokenType::LeftBrace);

        while (! $tokens->is(TokenType::RightBrace)) {
            $this->assertNotEof($tokens);

            $body[] = $this->node($tokens);
        }

        $tokens->expect(TokenType::RightBrace);

        $state->nodes[] = new Fn_($name, $parameters, $returnType, $body);
    }

    protected function expr(TokenStream $tokens): Expr
    {
        $token = $tokens->current();

        if ($token->type === TokenType::String) {
            $tokens->next();

            return new StringLiteral($token->value);
        }
    }

    protected function type(TokenStream $tokens): Type
    {
        $token = $tokens->current();

        return match ($token->type) {
            TokenType::Identifier => match ($token->value) {
                'string' => new StringType,
            },
        };
    }

    protected function assertNotEof(TokenStream $tokens): void
    {
        if ($tokens->isEof()) {
            throw new UnexpectedEndOfFileException;
        }
    }
}
