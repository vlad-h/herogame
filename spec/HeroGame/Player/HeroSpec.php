<?php

namespace spec\HeroGame\Player;

use HeroGame\Player\Hero;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HeroSpec extends ObjectBehavior
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
        $this->beConstructedWith(CONFIG['HERO']);
        $this->shouldHaveType(Hero::class);
    }

    public function it_speed_set()
    {
        $this->beConstructedWith(CONFIG['HERO']);
        $this->getSpeed()->shouldBeBetween(CONFIG['HERO']['speed']['min'], CONFIG['HERO']['speed']['max']);
    }

    public function it_health_set()
    {
        $this->beConstructedWith(CONFIG['HERO']);
        $this->getHealth()->shouldBeBetween(CONFIG['HERO']['health']['min'], CONFIG['HERO']['health']['max']);
    }

    public function it_strength_set()
    {
        $this->beConstructedWith(CONFIG['HERO']);
        $this->getStrength()->shouldBeBetween(CONFIG['HERO']['strength']['min'], CONFIG['HERO']['strength']['max']);
    }

    public function it_defence_set()
    {
        $this->beConstructedWith(CONFIG['HERO']);
        $this->getDefence()->shouldBeBetween(CONFIG['HERO']['defence']['min'], CONFIG['HERO']['defence']['max']);
    }

    public function it_luck_set()
    {
        $this->beConstructedWith(CONFIG['HERO']);
        $this->getLuck()->shouldBeBetween(CONFIG['HERO']['luck']['min'], CONFIG['HERO']['luck']['max']);
    }

    public function it_kills_player()
    {
        $this->beConstructedWith(CONFIG['HERO']);
        $this->receiveDamage(100);
        $this->isDead()->shouldReturn(true);
    }
}
