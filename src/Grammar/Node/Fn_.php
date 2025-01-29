<?php

namespace Neo\Grammar\Node;

use Neo\Grammar\Node\Type\Type;

class Fn_ implements Node
{
    /**
     * @param Parameter\Parameter[] $parameters
     * @param Node[] $body
     */
    public function __construct(
        public string $name,
        public array $parameters,
        public ?Type $returnType,
        public array $body,
    ) {}

    public function children(): array
    {
        return [
            $this->parameters,
            $this->returnType,
            $this->body,
        ];
    }
}
