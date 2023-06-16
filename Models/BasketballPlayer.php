<?php declare( strict_types = 1 );

namespace Models;

/**
 * BasketballPlayer model
 */
final class BasketballPlayer extends PlayerBase
{

    private int $scoredPoints;
    private int $rebounds;
    private int $assist;


    public function __construct(){}


    /**
     * @return int
     */
    public function getScoredPoints(): int
    {
        return $this->scoredPoints;
    }

    /**
     * @param int $scoredPoints
     */
    public function setScoredPoints(int $scoredPoints): void
    {
        $this->scoredPoints = $scoredPoints;
    }

    /**
     * @return int
     */
    public function getRebounds(): int
    {
        return $this->rebounds;
    }

    /**
     * @param int $rebounds
     */
    public function setRebounds(int $rebounds): void
    {
        $this->rebounds = $rebounds;
    }

    /**
     * @return int
     */
    public function getAssist(): int
    {
        return $this->assist;
    }

    /**
     * @param int $assist
     */
    public function setAssist(int $assist): void
    {
        $this->assist = $assist;
    }

}