<?php declare( strict_types = 1 );

namespace Helpers;

use http\Exception\InvalidArgumentException;
use Interfaces\ParserMachInterface;
use Models\HandballPlayer;
use Models\MatchData;
use Models\PlayersCollection;

class HandballHelper implements ParserMachInterface
{
    private static ?HandballHelper $instance = null;
    private int $pointsForWinGame;

    private function __construct(){
        $this->pointsForWinGame = intval(parse_ini_file('helpersConfig.ini', true)['handball']['handball_winner_points']);
    }

    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new HandballHelper();
        }

        return self::$instance;
    }

    public function parseDataToMatch(array $fileContentLines): MatchData
    {
        $matchData = new MatchData('Handball');
        $playersCollection = new PlayersCollection();

        if(empty($fileContentLines)){
            throw new InvalidArgumentException("File is empty, MVP won't be calculated");
        }

        foreach ($fileContentLines as $line) {
            $data = explode(';', $line);
            if (count($data) !== 7) {
                throw new InvalidArgumentException("Wrong file format, MVP won't be calculated");
            }
            $player = new HandballPlayer();
            $player->setName($data[0]);
            $player->setNickname($data[1]);
            $player->setNumber(intval($data[2]));
            $player->setTeamName($data[3]);
            $player->setPosition($data[4]);
            $player->setGoalsMade(intval($data[5]));
            $player->setGoalsReceived(intval($data[6]));
            $playersCollection->add($player);
        }
        $matchData->setPlayers($playersCollection);
        $matchData->setTotalTeamScoredPoints($this->getTotalTeamScore($playersCollection));
        $matchData->setWinnerTeam(array_search (max($matchData->getTotalTeamScoredPoints()), $matchData->getTotalTeamScoredPoints()));

        // Add points to winners players
        foreach ($matchData->getPlayers() as $player){
            $player->setTotalRating($this->calculateRatingPoints(
                $player->getPosition(),
                $player->getGoalsMade(),
                $player->getGoalsReceived(),
                $player->getTeamName() === $matchData->getWinnerTeam()
            ));
        }

        return $matchData;
    }

    private function calculateRatingPoints(string $position, int $goals_made, int $goals_received, bool $teamWinMatch): int
    {
        $scoreRules = [
            'F' => ['initialPoints'=> 20, 'goals_made' => 1, 'goals_received'=> -1],
            'G' => ['initialPoints'=> 50, 'goals_made' => 5, 'goals_received'=> -2],
        ];


        return ($scoreRules[$position]['initialPoints']) +
            ($goals_made * $scoreRules[$position]['goals_made']) +
            ($goals_received * $scoreRules[$position]['goals_received']) +
            ($this->pointsForWinGame * $teamWinMatch);
    }

    function getTotalTeamScore(PlayersCollection $playersData): array {
        $matchTeamPoints = [];

        foreach ($playersData as $player) {
            if (!empty($matchTeamPoints[$player->getTeamName()])) {
                $matchTeamPoints[$player->getTeamName()] += $player->getGoalsMade();
            }else{
                $matchTeamPoints[$player->getTeamName()] = $player->getGoalsMade();
            }
        }
        return $matchTeamPoints;
    }
}