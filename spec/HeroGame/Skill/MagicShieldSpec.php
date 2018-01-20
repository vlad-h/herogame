<?php

namespace spec\HeroGame\Skill;

use HeroGame\Skill\MagicShield;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MagicShieldSpec extends ObjectBehavior
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
        $this->shouldHaveType(MagicShield::class);
    }

    function it_skill_has_type()
    {
        $this->getType()->shouldReturn('defence');
    }

    function it_skill_is_execute()
    {
      $this->execute(50, 'defence')->shouldBeNullOrValue(25);
    }
}
