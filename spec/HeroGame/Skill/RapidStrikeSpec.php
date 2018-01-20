<?php

namespace spec\HeroGame\Skill;

use HeroGame\Skill\RapidStrike;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RapidStrikeSpec extends ObjectBehavior
{
    public function getMatchers() : array
    {
        return [
          'beNullOrValue' => function ($subject, $value) {
              if ($subject == null || $subject == $value) {
                  return true;
              }
              return false;
          }
        ];
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(RapidStrike::class);
    }

    function it_skill_has_type()
    {
        $this->getType()->shouldReturn('attack');
    }

    function it_skill_is_execute()
    {
      $this->execute(50, 'attack')->shouldBeNullOrValue(100);
    }
}
