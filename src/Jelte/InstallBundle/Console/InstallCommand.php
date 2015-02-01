<?php


namespace Jelte\InstallBundle\Console;


use Composer\IO\ConsoleIO;
use Incenteev\ParameterHandler\Processor;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ParametersCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('config:parameters')
            ->addOption('file', null, InputOption::VALUE_OPTIONAL, 'path to parameters.yml', 'app/config/parameters.yml')
            ->setDescription('');
    }


    public function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new ConsoleIO($input, $output, $this->getHelperSet());

        $processor = new Processor($io);

        $processor->processFile(array(
            'file' => $input->getOption('file')
        ));
    }
}