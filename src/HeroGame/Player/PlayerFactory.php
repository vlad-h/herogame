<?php

namespace HeroGame\Player;

class PlayerFactory
{
    /**
     * The is the factory which creates player objects
     * @param  array $config
     * @param  string $type
     * @throws Exception if the $type is not hero or beast
     * @return Hero|Beast
     */
    public static function factory(array $config, string $type = 'hero'): IPlayer
    {
        switch ($type) {
            case 'hero':
                return new Hero($config);
            case 'beast':
                return new Beast($config);
            default:
                throw new Exception("Player factory could not create player '{$type}'");
        }
    }
}
