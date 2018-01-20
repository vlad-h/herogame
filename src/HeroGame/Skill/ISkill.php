<?php

namespace HeroGame\Skill;

interface ISkill
{
  /**
   * Use the skill
   * @param  int    $value
   * @param  string $type
   * @return int|null
   */
  public function execute(int $value, string $type);
}
