<?php

namespace HeroGame\Player;

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
}
