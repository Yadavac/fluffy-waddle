<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;
use SebastianBergmann\Environment\Console;

/**
 * Class LovePlayer
 * @package Hackathon\PlayerIA
 * @author yverne_v
 */
class FalseFriendPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
        $this->prettyDisplay();
        $nbRound = $this->result->getNbRound();
        $foeChoice = parent::foeChoice();
        $friendChoice = parent::friendChoice();

        if ($nbRound < 3) {
            return $friendChoice;
        }

        return $foeChoice;
    }
};
