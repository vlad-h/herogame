<?php
namespace HeroGame\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use HeroGame\Player\PlayerFactory;
use Herogame\Player\IPlayer;
use HeroGame\Game;

class StartGame extends Command
{
    protected function configure()
    {
      $this
      ->setName('start')
      ->setDescription('Start Hero Game')
      ->setHelp('This command allows you to start the game');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
      $output->writeln('<info>--- HeroGame ---</info>');
      $game = new Game();

      $hero = PlayerFactory::factory(CONFIG['HERO'], 'hero');
      $beast = PlayerFactory::factory(CONFIG['BEAST'], 'beast');

      $game->setPlayers($hero, $beast);
      $firstPlayer = $game->decideFirstPlayer();

      $output->writeln("<info>The first player that will attack is {$firstPlayer->getName()} ({$firstPlayer->getType()})</info>");
      $output->writeln('<info>There are the players stats.</info>');

      $this->displayPlayers($output, $hero, $beast);
    }

    protected function displayPlayers(OutputInterface $output, IPlayer $hero, IPlayer $beast)
    {
      $table = new Table($output);
      $table->setHeaders([
        "",
        $hero->getName()." ({$hero->getType()})",
        $beast->getName()." ({$beast->getType()})"
      ]);
      $table->addRow(['Health', $hero->getHealth(), $beast->getHealth()]);
      $table->addRow(['Strength', $hero->getStrength(), $beast->getStrength()]);
      $table->addRow(['Defence', $hero->getDefence(), $beast->getDefence()]);
      $table->addRow(['Speed', $hero->getSpeed(), $beast->getSpeed()]);
      $table->addRow(['Luck', $hero->getLuck(), $beast->getLuck()]);

      $table->render();
    }
}
