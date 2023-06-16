<?php declare( strict_types = 1 );

namespace Models;

// Cannot use 'match' as an identifier. It is a reserved keyword since PHP 8.0

/**
 * Encapsule a match (txt file) parsed
 */
final class MatchData
{
    private PlayersCollection $players;
    private array $totalTeamScoredPoints;
    private string $winnerTeam;
    private string $sport;

    /**
     * @param string $sport
     */
    public function __construct(string $sport)
    {
        $this->sport = $sport;
    }


    /**
     * @return PlayersCollection
     */
    public function getPlayers(): PlayersCollection
    {
        return $this->players;
    }

    /**
     * @param PlayersCollection $players
     */
    public function setPlayers(PlayersCollection $players): void
    {
        $this->players = $players;
    }

    /**
     * @return array
     */
    public function getTotalTeamScoredPoints(): array
    {
        return $this->totalTeamScoredPoints;
    }

    /**
     * @param array $totalTeamScoredPoints
     */
    public function setTotalTeamScoredPoints(array $totalTeamScoredPoints): void
    {
        $this->totalTeamScoredPoints = $totalTeamScoredPoints;
    }

    /**
     * @return string
     */
    public function getWinnerTeam(): string
    {
        return $this->winnerTeam;
    }

    /**
     * @param string $winnerTeam
     */
    public function setWinnerTeam(string $winnerTeam): void
    {
        $this->winnerTeam = $winnerTeam;
    }

    /**
     * @return string
     */
    public function getSport(): string
    {
        return $this->sport;
    }

    /**
     * @param string $sport
     */
    public function setSport(string $sport): void
    {
        $this->sport = $sport;
    }



    /**
     * @return string
     */
    public function MatchMVP(): string
    {
        if(empty($this->players)){
            return 'No match data for MVP';
        }

        $tmpMVP = null;
        foreach ($this->players as $player){
            if($tmpMVP === null || $player->getTotalRating() > $tmpMVP->getTotalRating())
                $tmpMVP = $player;
        }

        return "The {$this->sport} MPV player in this match is: {$tmpMVP}";
    }


}