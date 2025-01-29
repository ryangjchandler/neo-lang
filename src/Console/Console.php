<?php

namespace Neo\Console;

use Symfony\Component\Console\Application;

class Console extends Application
{
    public function __construct()
    {
        parent::__construct('Neo', 'v0.1.0');

        $this->add(new Commands\BuildCommand());
    }
}
