<?php

namespace Neo\Grammar\Node\Type;

class StringType implements Type
{
    public function children(): array
    {
        return [];
    }

    public function __toString(): string
    {
        return 'string';
    }
}
