<?php

namespace Neo\Console\Commands;

use Neo\Grammar\Lexer;
use Neo\Grammar\Parser;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('build', 'Build your Neo project.')]
class BuildCommand extends Command
{
    public function __construct()
    {
        parent::__construct();

        $this->addArgument('file', InputArgument::REQUIRED, 'The Neo file to build.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln("Building your Neo project...");

        $code = file_get_contents($input->getArgument('file'));
        $tokens = (new Lexer)->tokenize($code);
        $ast = (new Parser)->parse($tokens);

        dd($ast);

        return self::SUCCESS;
    }
}
