<?php

namespace Neo\Grammar;

use Exception;

class UnexpectedEndOfFileException extends Exception
{
    public function __construct()
    {
        parent::__construct("Unexpected end of file.");
    }
}
