<?php

namespace HeroGame\Skill;

/**
 * All skills should extend this abstract skill class
 */
abstract class SkillAbstract
{
    /**
     * Calculate player probability
     * @param  int $probability
     * @return bool
     */
    public function checkProbability(int $probability): bool
    {
        $random = rand(0, 99);

        return $random <= $probability;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
