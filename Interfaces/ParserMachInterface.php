<?php declare( strict_types = 1 );

namespace Interfaces;

use Models\MatchData;
use Models\PlayersCollection;

interface ParserMachInterface
{
    function parseDataToMatch(array $fileContentLines): MatchData;
    function getTotalTeamScore(PlayersCollection $playersData): array;
}