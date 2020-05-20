<?php

namespace Matecat\LanguageTools\Command;

use Matecat\LanguageTools\Pipeline;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ProcessCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('mlt:process')
            ->setDescription('Process a string.')
            ->setHelp('This command processes a string with Matecat Language Tools algorythms.')
            ->addArgument('lang', InputArgument::REQUIRED, 'The language')
            ->addArgument('src', InputArgument::REQUIRED, 'The source string')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $src = $input->getArgument('src');
        $lang = $input->getArgument('lang');
        $io = new SymfonyStyle($input, $output);

        $pipeline = new Pipeline($lang);
        $isLanguageSupported = ($pipeline->isLanguageSupported($lang)) ? 'YES' : 'NO';

        $io->title('Matecat Language Tools');
        $io->write('<fg=green>Provided language</>: ' . $lang);
        $io->newLine();
        $io->write('<fg=green>Language is supported</>: ' . $isLanguageSupported );
        $io->newLine();
        $io->write('<fg=green>Original string</>: "' . $src . '"');
        $io->newLine();
        $io->write('<fg=green>Processed string</>: "' . $pipeline->process($src). '"');
        $io->newLine();
        $io->newLine();
    }
}
