<?php

namespace HeroGame;

use HeroGame\Player\IPLayer;

/**
 * Main game class
 */
class Game
{
    /**
     * @var IPLayer
     */
    private $hero;

    /**
     * @var IPlayer
     */
    private $beast;

    /**
     * @var IPlayer
     */
    private $firstPlayer;

    /**
     * Add players to the game
     * @param IPlayer $hero
     * @param IPlayer $beast
     */
    public function setPlayers(IPlayer $hero, IPlayer $beast)
    {
        $this->hero = $hero;
        $this->beast = $beast;
    }

    /**
     * Decide who will be the first player that attacks
     * @return IPlayer
     */
    public function decideFirstPlayer() : IPlayer
    {
      if($this->hero->getSpeed() !== $this->beast->getSpeed()){
        $this->firstPlayer = $this->hero->getSpeed() > $this->beast->getSpeed() ? $this->hero : $this->beast;
        return $this->firstPlayer;
      } else {
        $this->firstPlayer = $this->hero->getLuck() > $this->beast->getLuck() ? $this->hero : $this->beast;
        return $this->firstPlayer;
      }
    }
}
