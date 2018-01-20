<?php

namespace HeroGame\Player;

use HeroGame\Skill\SkillFactory;

/**
 * Hero class
 */
class Hero extends PlayerAbstract implements IPlayer
{
    /**
     * @var string
     */
    protected $name = 'Orderus';

    /**
     * @var string
     */
    protected $type = 'hero';

    /**
     * Hero class constructor
     */
    public function __construct($config)
    {
        parent::__construct($config);
        $this->loadSkills();
    }

    /**
     * Load hero skills objects
     */
    public function loadSkills()
    {
        foreach (CONFIG['HERO_SKILLS'] as $skill) {
            $this->skills[] = SkillFactory::factory($skill);
        }
    }

    /**
     * Use skills when hero is attacker or defender
     * @param  int $damage
     * @param  string $type
     */
    public function useSkills(&$damage, $type)
    {
        $this->usedSkills = [];
        foreach ($this->skills as $skill) {
            $result = $skill->execute($damage, $type);
            if ($result) {
                $damage = $result;
                $this->usedSkills[] = $skill->getName();
            }
        }
    }

    /**
     * Defender fight method
     * @param  IPlayer $attacker
     * @return int
     */
    public function fight(IPlayer $attacker) : int
    {
        $isLucky = $this->checkPlayersLuck();

        if (!$isLucky) {
            $damage = $attacker->getStrength() - $this->getDefence();
            $this->useSkills($damage, 'defence');

            $damage = min($damage, $this->getHealth());
            $this->receiveDamage($damage);

            return $damage;
        }

        return 0;
    }
}
