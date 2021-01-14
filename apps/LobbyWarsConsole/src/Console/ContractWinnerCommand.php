<?php

declare(strict_types=1);

namespace LobbyWarsConsole\Console;

use LobbyWars\Application\ContractWinner\ContractWinnerQuery;
use Shared\Domain\Bus\Query\QueryBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class ContractWinnerCommand extends Command
{
    protected static $defaultName = 'lobbyWars:contractWinner';

    private QueryBus $queryBus;

    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
        parent::__construct();
    }

    protected function configure()
    {
        $this->addArgument('firstContract', InputArgument::REQUIRED, 'First contract');
        $this->addArgument('secondContract', InputArgument::REQUIRED, 'Second contract');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln($input->getArgument('firstContract'));
        $output->writeln($input->getArgument('secondContract'));

        $this->queryBus->dispatch(new ContractWinnerQuery(
            $input->getArgument('firstContract'),
            $input->getArgument('secondContract')
        ));

        return Command::SUCCESS;
    }
}
