<?php

namespace Neo\Grammar\Node;

interface Node
{
    /**
     * @return Node[]
     */
    public function children(): array;
}
