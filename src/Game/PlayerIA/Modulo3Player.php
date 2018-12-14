<?php
namespace Hackathon\PlayerIA;
use Hackathon\Game\Result;
/**
 * Class LovePlayer
 * @package Hackathon\PlayerIA
 * @author PaulB
 */
class Modulo3Player extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;
    public function getChoice()
    {
        $nbRound = $this->result->getNbRound();

        if ($nbRound % 3 == 0)
            return parent::foeChoice();
        return parent::friendChoice();
    }

};