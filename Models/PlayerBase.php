<?php declare( strict_types = 1 );

namespace Models;

/**
 * Base player model for playerModel collection and inheritance
 */
abstract class PlayerBase
{
    private string $name;
    private string $nickname;
    private int $number;
    private string $teamName;
    private string $position;
    private bool $teanWins;
    private int $totalRating;

    /**
     * @return int
     */
    public function getTotalRating(): int
    {
        return $this->totalRating;
    }

    /**
     * @param int $totalRating
     */
    public function setTotalRating(int $totalRating): void
    {
        $this->totalRating = $totalRating;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @param string $nickname
     */
    public function setNickname(string $nickname): void
    {
        $this->nickname = $nickname;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getTeamName(): string
    {
        return $this->teamName;
    }

    /**
     * @param string $teamName
     */
    public function setTeamName(string $teamName): void
    {
        $this->teamName = $teamName;
    }

    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition(string $position): void
    {
        $this->position = $position;
    }

    /**
     * @return bool
     */
    public function isTeanWins(): bool
    {
        return $this->teanWins;
    }

    /**
     * @param bool $teanWins
     */
    public function setTeanWins(bool $teanWins): void
    {
        $this->teanWins = $teanWins;
    }

    /**
     * @return string
     */
    public function __toString() {
        return "Positiom {{$this->position}} in team {{$this->teamName}} with {{$this->totalRating}} points";
    }
}