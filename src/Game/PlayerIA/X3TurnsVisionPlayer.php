<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;
use SebastianBergmann\Environment\Console;

/**
 * Class LovePlayer
 * @package Hackathon\PlayerIA
 * @author yverne_v
 */
class X3TurnsVisionPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
        $nbRound = $this->result->getNbRound();
        $foeChoice = parent::foeChoice();
        $friendChoice = parent::friendChoice();

        if ($nbRound == 0) {
            return $foeChoice;
        }
        else if ($nbRound < 3) {
            if ($this->result->getLastChoiceFor($this->opponentSide) == $foeChoice)
                return $friendChoice;
            return $foeChoice;
        }

        //Opponent plays always foe
        if (($this->result->getChoicesFor($this->opponentSide)[$nbRound - 3] == $foeChoice)
            && ($this->result->getChoicesFor($this->opponentSide)[$nbRound - 2] == $foeChoice)
            && ($this->result->getChoicesFor($this->opponentSide)[$nbRound - 1] == $foeChoice))
            return $foeChoice;

        //Opponent plays always friend
        if (($this->result->getChoicesFor($this->opponentSide)[$nbRound - 3] == $friendChoice)
            && ($this->result->getChoicesFor($this->opponentSide)[$nbRound - 2] == $friendChoice)
            && ($this->result->getChoicesFor($this->opponentSide)[$nbRound - 1] == $friendChoice))
            return $foeChoice;

        //Opponent plays the same as my previous choice
        if (($this->result->getChoicesFor($this->opponentSide)[$nbRound - 2] == $this->result->getChoicesFor($this->mySide)[$nbRound - 3])
            && ($this->result->getChoicesFor($this->opponentSide)[$nbRound - 1] == $this->result->getChoicesFor($this->mySide)[$nbRound - 2]))
            return $this->result->getChoicesFor($this->opponentSide)[$nbRound - 1];

        //Opponent plays the reverse of my previous choice
        if (($this->result->getChoicesFor($this->opponentSide)[$nbRound - 2] != $this->result->getChoicesFor($this->mySide)[$nbRound - 3])
            && ($this->result->getChoicesFor($this->opponentSide)[$nbRound - 1] != $this->result->getChoicesFor($this->mySide)[$nbRound - 2]))
            return $foeChoice;

        return $friendChoice;
    }
};
