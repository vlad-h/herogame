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
    private $attacker;

    /**
     * @var int
     */
    private $round = 1;

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
    public function decideFirstPlayer(): IPlayer
    {
        if ($this->hero->getSpeed() !== $this->beast->getSpeed()) {
            $this->attacker = $this->hero->getSpeed() > $this->beast->getSpeed() ? $this->hero : $this->beast;
            return $this->attacker;
        } else {
            $this->attacker = $this->hero->getLuck() > $this->beast->getLuck() ? $this->hero : $this->beast;
            return $this->attacker;
        }
    }

    public function decideWinner()
    {
        if ($this->hero->getHealth() > $this->beast->getHealth()) {
            return $this->hero;
        } else if ($this->hero->getHealth() < $this->beast->getHealth()) {
            return $this->beast;
        }

        return null;
    }

    /**
     * Check if the game is over
     * @return bool
     */
    public function isGameOver(): bool
    {
        if ($this->hero->isDead() || $this->beast->isDead()) {
            return true;
        }

        if ($this->round > CONFIG['GAME_ROUNDS']) {
            return true;
        }

        return false;
    }

    /**
     * Player battle turns
     * @return array
     */
    public function battleRound(): array
    {
        if (!$this->attacker) {
            $this->decideFirstPlayer();
        }

        $damage = $this->getDefender()->fight($this->attacker);

        $roundData = [
            'round' => $this->round,
            'attacker' => $this->attacker->getName(),
            'defender_health' => $this->getDefender()->getHealth(),
            'damage' => $damage,
            'is_lucky' => $this->getDefender()->isLucky(),
            'skill_used' => $this->attacker->getUsedSkills() ? implode(',', $this->attacker->getUsedSkills()) : implode(',', $this->getDefender()->getUsedSkills())
        ];

        $this->changePlayerTurn();

        return $roundData;
    }

    /**
     * Change player turn
     */
    public function changePlayerTurn()
    {
        $this->attacker = $this->getDefender();
        $this->round++;
    }

    /**
     * Get the defender player
     * @return IPlayer
     */
    public function getDefender(): IPlayer
    {
        return $this->attacker->getType() == 'hero' ? $this->beast : $this->hero;
    }

    /**
     * @return int
     */
    public function getRound(): int
    {
        return $this->round;
    }
}
