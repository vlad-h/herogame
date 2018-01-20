<?php

namespace HeroGame\Skill;

/**
 * Magic Shield Skill Class
 */
class MagicShield extends SkillAbstract implements ISkill
{
    /**
     * @var string
     */
    protected $name = 'Magic Shield';

    /**
     * @var string
     */
    protected $description = 'Takes only half of the usual damage when an enemy attacks';

    /**
     * @var int
     */
    protected $probability = 20;

    /**
     * @var string
     */
    protected $type = 'defence';

    /**
     * @param  int    $value
     * @param  string $type
     * @return int|null
     */
    public function execute(int $value, string $type)
    {
        if ($type == $this->type && $this->checkProbability($this->probability)) {
            return (int)($value / 2);
        }
        return null;
    }
}
