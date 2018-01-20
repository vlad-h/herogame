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
}
