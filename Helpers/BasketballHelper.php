<?php declare( strict_types = 1 );

namespace Helpers;

use http\Exception\InvalidArgumentException;
use Interfaces\ParserMachInterface;
use Models\BasketballPlayer;
use Models\MatchData;
use Models\PlayersCollection;

final class BasketballHelper implements ParserMachInterface
{
    private static ?BasketballHelper $instance = null;
    private int $pointsForWinGame;

    private function __construct(){
        $this->pointsForWinGame = intval(parse_ini_file('helpersConfig.ini', true)['basketball']['basketball_winner_points']);
    }

    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new BasketballHelper();
        }

        return self::$instance;
    }

    // Validate and parse handball match file
    // Each row will represent one player stats, with the format:
    // player name;nickname;number;team name;position;goals made;goals received
    public function parseDataToMatch(array $fileContentLines): MatchData{
        $matchData = new MatchData('Basketball');
        $playersCollection = new PlayersCollection();

        if(empty($fileContentLines)){
            throw new InvalidArgumentException("File is empty, MVP won't be calculated");
        }

        foreach ($fileContentLines as $line) {
            $data = explode(';', $line);
            if (count($data) !== 8) {
                throw new InvalidArgumentException("Wrong file format, MVP won't be calculated");
            }
            // We can use factory pattern here
            $player = new BasketballPlayer();
            $player->setName($data[0]);
            $player->setNickname($data[1]);
            $player->setNumber(intval($data[2]));
            $player->setTeamName($data[3]);
            $player->setPosition($data[4]);
            $player->setScoredPoints(intval($data[5]));
            $player->setRebounds(intval($data[6]));
            $player->setAssist(intval($data[7]));
            $playersCollection->add($player);
        }
        $matchData->setPlayers($playersCollection);
        $matchData->setTotalTeamScoredPoints($this->getTotalTeamScore($playersCollection));
        $matchData->setWinnerTeam(array_search (max($matchData->getTotalTeamScoredPoints()), $matchData->getTotalTeamScoredPoints()));

        // Add points to winners players
        foreach ($matchData->getPlayers() as $player){
            $player->setTotalRating($this->calculateBasketballRatingPoints(
                $player->getPosition(),
                $player->getScoredPoints(),
                $player->getRebounds(),
                $player->getAssist(),
                $player->getTeamName() === $matchData->getWinnerTeam()
            ));
        }
        return $matchData;
    }

    private function calculateBasketballRatingPoints($position, $scoredPoints, $rebounds, $assists, $teamWinMatch): int
    {
        $scoreRules = [
            'C' => ['score'=> 2, 'rebounds' => 1, 'assists'=> 3],
            'F' => ['score'=> 2, 'rebounds' => 2, 'assists'=> 2],
            'G' => ['score'=> 2, 'rebounds' => 3, 'assists'=> 1],
        ];

        return ($scoredPoints * $scoreRules[$position]['score']) +
            ($rebounds * $scoreRules[$position]['rebounds']) +
            ($assists * $scoreRules[$position]['assists']) +
            ($this->pointsForWinGame * $teamWinMatch);

    }

    function getTotalTeamScore(PlayersCollection $playersData): array
    {
        $matchTeamPoints = [];

        foreach ($playersData as $player) {
            if (!empty($matchTeamPoints[$player->getTeamName()])) {
                $matchTeamPoints[$player->getTeamName()] += $player->getScoredPoints();
            }else{
                $matchTeamPoints[$player->getTeamName()] = $player->getScoredPoints();
            }
        }
        return $matchTeamPoints;
    }
}