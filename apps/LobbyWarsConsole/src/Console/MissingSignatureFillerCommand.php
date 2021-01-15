<?php

declare(strict_types=1);

namespace LobbyWarsConsole\Console;

use LobbyWars\Application\MissingSignatureFiller\MissingSignatureFillerQuery;
use LobbyWars\Application\MissingSignatureFiller\MissingSignatureFillerResponse;
use Shared\Domain\Bus\Query\QueryBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

class MissingSignatureFillerCommand extends Command
{
    protected static $defaultName = 'lobbyWars:missingSignatureFiller';

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
        try {
            /** @var MissingSignatureFillerResponse $response */
            $response = $this->queryBus->dispatch(new MissingSignatureFillerQuery(
                $input->getArgument('firstContract'),
                $input->getArgument('secondContract')
            ));

            $output->writeln('Missing signature: '.$response->signature());
            return Command::SUCCESS;
        } catch (Throwable $exception) {
            $output->writeln($exception->getMessage());
            return Command::FAILURE;
        }
    }
}
