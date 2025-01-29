<?php

namespace Neo\Grammar;

use RyanChandler\Lexical\Attributes\Lexer;
use RyanChandler\Lexical\Attributes\Literal;
use RyanChandler\Lexical\Attributes\Regex;

#[Lexer(skip: '\s+')]
enum TokenType
{
    // Keywords
    #[Literal('fn')]
    case Fn;
    #[Literal('echo')]
    case Echo;

    // Literals and Identifiers
    #[Regex('[a-zA-Z_][a-zA-Z0-9_]*')]
    case Identifier;
    #[Regex('-[a-zA-Z]+')]
    case ShortOption;
    #[Regex('--[a-zA-Z]+[a-zA-Z-_]*')]
    case LongOption;
    #[Regex('"([^"\\]|\\[\s\S])*"')]
    case String;

    // Punctuation
    #[Literal('{')]
    case LeftBrace;
    #[Literal('}')]
    case RightBrace;
    #[Literal('(')]
    case LeftParen;
    #[Literal(')')]
    case RightParen;
    #[Literal(',')]
    case Comma;
    #[Literal(':')]
    case Colon;
    #[Literal(';')]
    case SemiColon;
}
