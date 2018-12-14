<?php

namespace Hackathon\PlayerIA;

use Hackathon\Game\Result;
use SebastianBergmann\Environment\Console;

/**
 * Class LovePlayer
 * @package Hackathon\PlayerIA
 * @author yverne_v
 */
class YadavacPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;

    public function getChoice()
    {
        $nbRound = $this->result->getNbRound();
        $foeChoice = parent::foeChoice();
        $friendChoice = parent::friendChoice();

        //The 1st round I play "Foe"
        if ($nbRound == 0) {
            return $foeChoice;
        }
        else if ($nbRound < 3) {
            if ($this->result->getLastChoiceFor($this->opponentSide) == $foeChoice)
                return $friendChoice;
            return $foeChoice;
        }

        //Here I try to recognize what strategy my opponent is playing, and i counter-play accordingly.
        //I do this for the last 3 turns to try to anticipate the changes in his strategy.

        //Opponent always plays foe -> I play "Foe" to deny the points
        if (($this->result->getChoicesFor($this->opponentSide)[$nbRound - 3] == $foeChoice)
            && ($this->result->getChoicesFor($this->opponentSide)[$nbRound - 2] == $foeChoice)
            && ($this->result->getChoicesFor($this->opponentSide)[$nbRound - 1] == $foeChoice))
            return $foeChoice;

        //Opponent always plays friend -> I play "Foe" to gain the points
        if (($this->result->getChoicesFor($this->opponentSide)[$nbRound - 3] == $friendChoice)
            && ($this->result->getChoicesFor($this->opponentSide)[$nbRound - 2] == $friendChoice)
            && ($this->result->getChoicesFor($this->opponentSide)[$nbRound - 1] == $friendChoice))
            return $foeChoice;

        //Opponent plays the same as my previous choice -> I do the same
        if (($this->result->getChoicesFor($this->opponentSide)[$nbRound - 2] == $this->result->getChoicesFor($this->mySide)[$nbRound - 3])
            && ($this->result->getChoicesFor($this->opponentSide)[$nbRound - 1] == $this->result->getChoicesFor($this->mySide)[$nbRound - 2]))
            return $this->result->getChoicesFor($this->opponentSide)[$nbRound - 1];

        //Opponent plays the reverse of my previous choice -> I play "Foe" so he play "Friend" and I gain the points
        if (($this->result->getChoicesFor($this->opponentSide)[$nbRound - 2] != $this->result->getChoicesFor($this->mySide)[$nbRound - 3])
            && ($this->result->getChoicesFor($this->opponentSide)[$nbRound - 1] != $this->result->getChoicesFor($this->mySide)[$nbRound - 2]))
            return $foeChoice;

        //If the "strat" is not recognized, I play as a friend
        return $friendChoice;
    }
};
