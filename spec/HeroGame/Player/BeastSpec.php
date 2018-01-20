<?php

namespace spec\HeroGame\Player;

use HeroGame\Player\Beast;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BeastSpec extends ObjectBehavior
{
    public function getMatchers() : array
    {
        return [
          'beBetween' => function ($subject, $min, $max) {
              if ($subject >= $min && $subject <= $max) {
                  return true;
              }
              return false;
          }
        ];
    }

    public function it_is_initializable()
    {
        $this->beConstructedWith(CONFIG['BEAST']);
        $this->shouldHaveType(Beast::class);
    }

    public function it_speed_set()
    {
        $this->beConstructedWith(CONFIG['BEAST']);
        $this->getSpeed()->shouldBeBetween(CONFIG['BEAST']['speed']['min'], CONFIG['BEAST']['speed']['max']);
    }

    public function it_health_set()
    {
        $this->beConstructedWith(CONFIG['BEAST']);
        $this->getHealth()->shouldBeBetween(CONFIG['BEAST']['health']['min'], CONFIG['BEAST']['health']['max']);
    }

    public function it_strength_set()
    {
        $this->beConstructedWith(CONFIG['BEAST']);
        $this->getStrength()->shouldBeBetween(CONFIG['BEAST']['strength']['min'], CONFIG['BEAST']['strength']['max']);
    }

    public function it_defence_set()
    {
        $this->beConstructedWith(CONFIG['BEAST']);
        $this->getDefence()->shouldBeBetween(CONFIG['BEAST']['defence']['min'], CONFIG['BEAST']['defence']['max']);
    }

    public function it_luck_set()
    {
        $this->beConstructedWith(CONFIG['BEAST']);
        $this->getLuck()->shouldBeBetween(CONFIG['BEAST']['luck']['min'], CONFIG['BEAST']['luck']['max']);
    }

    public function it_kills_player()
    {
        $this->beConstructedWith(CONFIG['BEAST']);
        $this->receiveDamage(100);
        $this->isDead()->shouldReturn(true);
    }
}
