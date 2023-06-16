<?php declare( strict_types = 1 );

use Helpers\BasketballHelper;
use Helpers\FileHelper;
use Helpers\GetMVPHelper;
use Helpers\HandballHelper;

// Custom autoload
require_once('./Helpers/Autoload.php');

$fileHelper = new FileHelper();

$sportData = $fileHelper->getSportData();
GetMVPHelper::writeMVPOutput(calcMVPBySport($sportData));







function calcMVPBySport($data){
    $allMatches = [];

    foreach ($data as $mvp){
        $sport = strtolower($mvp['sport']);
        switch ($sport) {
            case "basketball":
                $allMatches[] = BasketballHelper::getInstance()->parseDataToMatch($mvp['content']);
                break;
            case "handball":
                $allMatches[] = HandballHelper::getInstance()->parseDataToMatch($mvp['content']);
                break;
            default:
                break;
        }
    }
    return $allMatches;

}



