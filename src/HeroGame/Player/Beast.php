<?php

namespace HeroGame\Player;

/**
 * Beast class
 */
class Beast extends PlayerAbstract implements IPlayer
{
    /**
     * @var string
     */
    protected $name = 'Diablo';

    /**
     * @var string
     */
    protected $type = 'beast';

    /**
     * Defender fight method
     * @param  IPlayer $attacker
     * @return int
     */
    public function fight(IPlayer $attacker): int
    {
        $isLucky = $this->checkPlayersLuck();

        if (!$isLucky) {
            $damage = $attacker->getStrength() - $this->getDefence();
            $attacker->useSkills($damage, 'attack');

            $damage = min($damage, $this->getHealth());
            $this->receiveDamage($damage);

            return $damage;
        }

        return 0;
    }
}
