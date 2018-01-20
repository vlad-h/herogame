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
        $output->writeln("\n<info>--- HEROGAME ---</info>\n");
        $game = new Game();

        $hero = PlayerFactory::factory(CONFIG['HERO'], 'hero');
        $beast = PlayerFactory::factory(CONFIG['BEAST'], 'beast');

        $game->setPlayers($hero, $beast);
        $firstPlayer = $game->decideFirstPlayer();

        $output->writeln('<info>These are the players stats.</info>');
        $this->displayPlayers($output, $hero, $beast);

        $output->writeln("<info>The first player that will attack is {$firstPlayer->getName()} ({$firstPlayer->getType()})</info>");
        $output->writeln("\n<info>START BATTLE</info>\n");

        $roundsData = [];
        while (!$game->isGameOver()) {
            $roundsData[] = $game->battleRound();
        }
        $this->displayBattleRound($output, $roundsData);
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

    protected function displayBattleRound(OutputInterface $output, array $roundsData)
    {
        $table = new Table($output);
        $table->setHeaders([
          "Round",
          "Attacker",
          "Damage",
          "Defender Health",
          "Defender Is Lucky",
          "Skill"
        ]);

        foreach ($roundsData as $round) {
            $table->addRow([$round['round'], $round['attacker'], $round['damage'], $round['defender_health'], $round['is_lucky'], $round['skill_used']]);
        }

        $table->render();
    }
}
