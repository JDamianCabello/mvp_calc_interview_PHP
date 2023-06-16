<?php declare( strict_types = 1 );

namespace Helpers;

/**
 * Helper for read files, this can be a singleton class
 */
final class FileHelper
{

    private string $sportDataFolderPath;

    function __construct() {
        $this->sportDataFolderPath = parse_ini_file('helpersConfig.ini', true)['global']['sportDataFolderPath'];
    }

    private function getDirectorySportFiles(): array{
        $files = array_diff(scandir($this->sportDataFolderPath), array('.', '..'));
        return preg_filter('/^/', $this->sportDataFolderPath.'/', $files);
    }

    private function getFileContent($filePath): array{
        $fileContentArray = explode("\n", file_get_contents($filePath, true));

        return [
            'sport' => $fileContentArray[0],
            'filePath' => $filePath,
            'content' => array_splice($fileContentArray, 1)
        ];;
    }

    public function getSportData()
    {
        $sportFiles = $this->getDirectorySportFiles();

        $filesData = [];
        foreach ($sportFiles as $file){
            $filesData[] = $this->getFileContent($file);
        }

        return $filesData;
    }




}