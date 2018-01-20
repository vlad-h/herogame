<?php

namespace HeroGame\Skill;

class SkillFactory
{
    /**
     * The is the factory which creates skill objects
     * @param  string $skillName
     * @return ISkill
     */
    public static function factory(string $skillName): ISkill
    {
        $className = str_replace(' ', '', $skillName);
        $className = 'HeroGame\\Skill\\' . $className;
        if (class_exists($className)) {
            return new $className();
        } else {
            throw new Exception("Skill factory could not create skill '{$skillName}'");
        }
    }
}
