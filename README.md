#Dependencies

- Docker

# Installation

Execute `make build` to download Docker container and install all composer dependencies.

# Basic usage

Once project is downloaded, we will execute:
- `make start` to start the container.
- `make stop` to stop the container.
- `make test` to run all unit tests.
- `make shell` to use interactive shell (to execute symfony commands)

For more actions, execute `make` without arguments.

#Lobby Wars

##First phase: how to run
The entry point for this use case is the `ContractWinnerCommand`, which always expects **2** arguments. If there is any problem, captures the exception in this point. 

In order to execute, you should:
- Type `make shell` to access into the container shell
- Type `php apps/LobbyWarsConsole/bin/console lobbyWars:contractWinner $1 $2` where `$1` and `$2` are the signatures you want test (e.g., `KN`)

The command output will show the winner signatures, according to the specified rules.

##Second phase: how to run
The entry point for this use case is the `MissingSignatureFillerCommand`, which always expects **2** arguments. If there is any problem, captures the exception in this point. 

In order to execute, you should:
- Type `make shell` to access into the container shell
- Type `php apps/LobbyWarsConsole/bin/console lobbyWars:missingSignatureFiller $1 $2` where `$1` and `$2` are the signatures you want test (e.g., `K#N`)

The command output will show the least signature needed to win.

## Notes
- The hiring test **does not specify how the app should behave in case of tie** (the signatures have the same value). I solved this situation by simply returning the first party.
- The hiring test **does not specify how the app should handle in case of impossible win** (for second phase). I solved this problem by throwing the `MissingSignatureCannotBeSolved` exception.  

### Tech disclaimer
In order to take advantage of all the Symfony pieces (Dependency container, CLI-commands, buses...) I installed the said framework. However, I chose a decoupled installation to maintain clean the `src` folder.

I only used `queries` because all the use cases return values, there is no need to perform commands. 

I took advantage of the prebuilt Symfony `query bus` as you can check at the `services.yaml`; the same applies to the CLI client and the Dependency Container which is autowired thanks to the black magic of SensioLabs.

### How to run tests     
- Type `make test` in order to run all unit tests. You also will see a little summary showing the code coverage. 
