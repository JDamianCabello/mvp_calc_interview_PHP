<?php declare( strict_types = 1 );

namespace Models;

/**
 * HandballPlayer model
 */
final class HandballPlayer extends PlayerBase
{

    private int $goalsMade;
    private int $goalsReceived;


    public function __construct(){}

    /**
     * @return int
     */
    public function getGoalsMade(): int
    {
        return $this->goalsMade;
    }

    /**
     * @param int $goalsMade
     */
    public function setGoalsMade(int $goalsMade): void
    {
        $this->goalsMade = $goalsMade;
    }

    /**
     * @return int
     */
    public function getGoalsReceived(): int
    {
        return $this->goalsReceived;
    }

    /**
     * @param int $goalsReceived
     */
    public function setGoalsReceived(int $goalsReceived): void
    {
        $this->goalsReceived = $goalsReceived;
    }



}