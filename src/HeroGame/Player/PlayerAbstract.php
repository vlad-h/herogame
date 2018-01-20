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
     * @var bool
     */
    protected $isLucky = false;

    /**
     * @var array
     */
    protected $skills = [];

    /**
     * @var array
     */
    protected $usedSkills = [];

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
    public function getSpeed(): int
    {
        return $this->speed;
    }

    /**
     * @return int
     */
    public function getLuck(): int
    {
        return $this->luck;
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

    /**
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * @return int
     */
    public function getDefence(): int
    {
        return $this->defence;
    }

    /**
     * @return bool
     */
    public function isDead(): bool
    {
        return $this->health > 0 ? false : true;
    }

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
     * @param  int $damage
     * @return int New health
     */
    public function receiveDamage(int $damage): int
    {
        $this->health = $this->health - $damage;

        return $this->health;
    }

    /**
     * @return bool
     */
    public function isLucky(): bool
    {
        return $this->isLucky;
    }

    /**
     * @return bool
     */
    public function checkPlayersLuck(): bool
    {
        $this->isLucky = $this->checkProbability($this->luck);

        return $this->isLucky;
    }

    /**
     * @return array
     */
    public function getSkills(): array
    {
        return $this->skills;
    }

    /**
     * @return array
     */
    public function getUsedSkills(): array
    {
        return $this->usedSkills;
    }
}
