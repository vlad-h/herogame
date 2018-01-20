<?php

namespace HeroGame\Skill;

/**
 * Rapid Strike Skill Class
 */
class RapidStrike extends SkillAbstract implements ISkill
{
    /**
     * @var string
     */
    protected $name = 'Rapid Strike';

    /**
     * @var string
     */
    protected $description = 'Strike twice while it’s his turn to attack';

    /**
     * @var int
     */
    protected $probability = 10;

    /**
     * @var string
     */
    protected $type = 'attack';

    /**
     * Use the skill
     * @param  int $value
     * @param  string $type
     * @return int|null
     */
    public function execute(int $value, string $type)
    {
        if ($type == $this->type && $this->checkProbability($this->probability)) {
            return $value * 2;
        }
        return null;
    }
}
