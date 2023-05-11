<?php /** @noinspection ALL */

namespace App\Command;

use generator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BankLoadCommand extends Command
{
    protected function configure()
    {
        $this->setDescription('Import list of banks');
        $this->setName('bank:load');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $text = "Import some data \n";
        $output->writeln($text);
        return Command::SUCCESS;
    }
}