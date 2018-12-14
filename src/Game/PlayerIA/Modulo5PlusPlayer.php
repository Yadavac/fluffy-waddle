<?php
namespace Hackathon\PlayerIA;
use Hackathon\Game\Result;
/**
 * Class LovePlayer
 * @package Hackathon\PlayerIA
 * @author PaulB
 */

class Modulo5PlusPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;
    public function getChoice()
    {
        if ($this->result->getNbRound() % 5 == 0 || $this->result->getNbRound() % 5 == 3)
            return parent::foeChoice();
        return parent::friendChoice();
    }

};