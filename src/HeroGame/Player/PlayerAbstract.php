<?php

namespace HeroGame\Player;

/**
 * All players should extend this abstract player class
 */
abstract class PlayerAbstract
{
    /**
     * @var int
     */
    protected $health;

    /**
     * @var int
     */
    protected $strength;

    /**
     * @var int
     */
    protected $defence;

    /**
     * @var int
     */
    protected $speed;

    /**
     * @var int
     */
    protected $luck;

    /**
     * Constructor class
     * @param array $config Player configuration
     */
    public function __construct(array $config)
    {
        // Dynamic set properties values
        foreach ($config as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = rand($value['min'], $value['max']);
            }
        }
    }

    /**
     * @return int
     */
    public function getSpeed() : int
    {
      return $this->speed;
    }

    /**
     * @return int
     */
    public function getLuck() : int
    {
      return $this->luck;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
      return $this->name;
    }

    /**
     * @return string
     */
    public function getType() : string
    {
      return $this->type;
    }

    /**
     * @return int
     */
    public function getHealth() : int
    {
      return $this->health;
    }

    /**
     * @return int
     */
    public function getStrength() : int
    {
      return $this->strength;
    }

    /**
     * @return int
     */
    public function getDefence() : int
    {
      return $this->defence;
    }
}
