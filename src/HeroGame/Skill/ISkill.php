<?php

namespace HeroGame\Skill;

interface ISkill
{
  /**
   * Use the skill
   * @param  int    $value
   * @return int|null
   */
  public function execute(int $value);
}
