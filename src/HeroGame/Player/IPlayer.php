<?php

namespace HeroGame\Player;

interface IPlayer
{
    /**
     * @return int
     */
    public function getSpeed(): int;

    /**
     * @return int
     */
    public function getLuck(): int;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return int
     */
    public function getHealth(): int;

    /**
     * @return int
     */
    public function getStrength(): int;

    /**
     * @return int
     */
    public function getDefence(): int;

    /**
     * @return bool
     */
    public function isDead(): bool;

    /**
     * Calculate player probability
     * @param  int $probability
     * @return bool
     */
    public function checkProbability(int $probability): bool;

    /**
     * @param  int $damage
     * @return int New health
     */
    public function receiveDamage(int $damage): int;

    /**
     * @return bool
     */
    public function isLucky(): bool;

    /**
     * @return bool
     */
    public function checkPlayersLuck(): bool;

    /**
     * Defender fight method
     * @param  IPlayer $attacker
     * @return int
     */
    public function fight(IPlayer $attacker): int;
}
