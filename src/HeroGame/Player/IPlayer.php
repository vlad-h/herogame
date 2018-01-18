<?php

namespace HeroGame\Player;

interface IPlayer
{
    /**
     * @return int
     */
    public function getSpeed() : int;

    /**
     * @return int
     */
    public function getLuck() : int;

    /**
     * @return string
     */
    public function getName() : string;

    /**
     * @return string
     */
    public function getType() : string;

    /**
     * @return int
     */
    public function getHealth() : int;

    /**
     * @return int
     */
    public function getStrength() : int;

    /**
     * @return int
     */
    public function getDefence() : int;
}
