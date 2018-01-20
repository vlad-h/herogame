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
        $output->writeln("\n--- HEROGAME ---\n");
        $game = new Game();

        $hero = PlayerFactory::factory(CONFIG['HERO'], 'hero');
        $beast = PlayerFactory::factory(CONFIG['BEAST'], 'beast');

        $game->setPlayers($hero, $beast);
        $firstPlayer = $game->decideFirstPlayer();

        $output->writeln('These are the players stats.');
        $this->displayPlayers($output, $hero, $beast);

        $output->writeln("\nSTART BATTLE\n");
        $output->writeln("The first player that will attack is {$firstPlayer->getName()} ({$firstPlayer->getType()})");
        $roundsData = [];
        while (!$game->isGameOver()) {
            $roundsData[] = $game->battleRound();
        }

        $this->displayBattleRounds($output, $roundsData);

        $output->writeln("\nGAME OVER\n");
        $winner = $game->decideWinner();
        if ($winner) {
            $output->writeln("The winner is {$winner->getName()}");
        } else {
            $output->writeln("The battle is a DRAW");
        }
    }

    protected function displayPlayers(OutputInterface $output, IPlayer $hero, IPlayer $beast)
    {
        $table = new Table($output);
        $table->setHeaders([
            "",
            $hero->getName() . " ({$hero->getType()})",
            $beast->getName() . " ({$beast->getType()})"
        ]);

        $table->addRow(['Health', $hero->getHealth(), $beast->getHealth()]);
        $table->addRow(['Strength', $hero->getStrength(), $beast->getStrength()]);
        $table->addRow(['Defence', $hero->getDefence(), $beast->getDefence()]);
        $table->addRow(['Speed', $hero->getSpeed(), $beast->getSpeed()]);
        $table->addRow(['Luck', $hero->getLuck(), $beast->getLuck()]);

        $table->render();
    }

    protected function displayBattleRounds(OutputInterface $output, array $roundsData)
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
