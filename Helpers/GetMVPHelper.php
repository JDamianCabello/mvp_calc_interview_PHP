<?php declare( strict_types = 1 );

namespace Helpers;

class GetMVPHelper
{
    /**
     * File to show console output
     * @param array $matches
     * @return void
     */
    public static function writeMVPOutput(array $matches): void{
        $players = [];

        echo "PLAYERS RESUME POINTS:\n\n";
        foreach ($matches as $match){
            $matchPlayers = $match->getPlayers();
            echo "[{$match->getSport()}]\n------------------------\n";

            foreach ($matchPlayers as $player){
                if (!empty($players[$player->getName()])) {
                    $players[$player->getName()] += $player->getTotalRating();
                }else {
                    $players[$player->getName()] = $player->getTotalRating();
                }
                echo "[{$player->getName()}] -> {$player->getTotalRating()} \n";
            }

            echo "\n\n";
        }

        $mvp = array_search (max($players), $players);

        echo "=========================\n\tRESULT:\n=========================\n";
        echo "The MVP is {$mvp} with ".max($players)." points, theres a resume of games.\n";

        foreach ($matches as $match){
            $matchPlayers = $match->getPlayers();
            echo "[{$match->getSport()}]: ";

            foreach ($matchPlayers as $player){
                if ($player->getName() === $mvp)
                    echo $player;
            }

            echo " | winner team: {$match->getWinnerTeam()}\n";
        }
    }
}