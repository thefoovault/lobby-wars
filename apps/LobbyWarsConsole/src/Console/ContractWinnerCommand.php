<?php

declare(strict_types=1);

namespace LobbyWarsConsole\Console;

use LobbyWars\Application\ContractWinner\ContractWinnerQuery;
use LobbyWars\Application\ContractWinner\ContractWinnerResponse;
use Shared\Domain\Bus\Query\QueryBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class ContractWinnerCommand extends Command
{
    protected static $defaultName = 'lobbyWars:contractWinner';

    private const FIRST_ARGUMENT = 'firstContract';
    private const SECOND_ARGUMENT = 'secondContract';

    private QueryBus $queryBus;

    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
        parent::__construct();
    }

    protected function configure()
    {
        $this->addArgument(self::FIRST_ARGUMENT, InputArgument::REQUIRED, 'First contract');
        $this->addArgument(self::SECOND_ARGUMENT, InputArgument::REQUIRED, 'Second contract');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var ContractWinnerResponse $response */
        $response = $this->queryBus->dispatch(new ContractWinnerQuery(
            $input->getArgument('firstContract'),
            $input->getArgument('secondContract')
        ));

        $output->writeln('Winner: '.$response->signatures());
        return Command::SUCCESS;
    }
}
