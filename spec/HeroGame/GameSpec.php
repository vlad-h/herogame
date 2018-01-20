<?php

namespace spec\HeroGame;

use HeroGame\Game;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use HeroGame\Player\IPLayer;
use HeroGame\Player\Hero;
use HeroGame\Player\Beast;
use HeroGame\Player\PlayerFactory;

define('CONFIG', [
  'GAME_ROUNDS' => 20,
  'HERO_SKILLS' => ['Rapid Strike', 'Magic Shield'],
  'HERO' => [
    'health' => ['min' => 70, 'max' => 100],
    'strength' => ['min' => 70, 'max' => 80],
    'defence' => ['min' => 45, 'max' => 55],
    'speed' => ['min' => 40, 'max' => 50],
    'luck' => ['min' => 10, 'max' => 30],
  ],
  'BEAST' => [
    'health' => ['min' => 60, 'max' => 90],
    'strength' => ['min' => 60, 'max' => 90],
    'defence' => ['min' => 40, 'max' => 60],
    'speed' => ['min' => 40, 'max' => 60],
    'luck' => ['min' => 25, 'max' => 40],
  ]
]);

class GameSpec extends ObjectBehavior
{

    function it_is_initializable()
    {
        $this->shouldHaveType(Game::class);
    }

    function it_decide_the_first_player()
    {

      $hero = PlayerFactory::factory(CONFIG['HERO'], 'hero');
      $beast = PlayerFactory::factory(CONFIG['BEAST'], 'beast');

      $this->setPlayers($hero, $beast);
      $this->decideFirstPlayer()->shouldHaveType(IPlayer::class);
    }

    function it_checks_if_game_is_over()
    {
      $hero = PlayerFactory::factory(CONFIG['HERO'], 'hero');
      $beast = PlayerFactory::factory(CONFIG['BEAST'], 'beast');

      $game = $this->getWrappedObject();

      $game->setPlayers($hero, $beast);

      while (!$game->isGameOver()) {
        $game->battleRound();
      }

      $this->isGameOver()->shouldReturn(true);
    }

    function it_get_defender()
    {
      $hero = PlayerFactory::factory(CONFIG['HERO'], 'hero');
      $beast = PlayerFactory::factory(CONFIG['BEAST'], 'beast');

      $this->setPlayers($hero, $beast);
      $this->decideFirstPlayer();
      $this->getDefender()->shouldHaveType(IPlayer::class);
    }

    function it_check_new_round()
    {
      $hero = PlayerFactory::factory(CONFIG['HERO'], 'hero');
      $beast = PlayerFactory::factory(CONFIG['BEAST'], 'beast');

      $game = $this->getWrappedObject();

      $game->setPlayers($hero, $beast);
      $game->decideFirstPlayer();
      $game->changePlayerTurn();

      $this->getRound()->shouldReturn(2);
    }
}
