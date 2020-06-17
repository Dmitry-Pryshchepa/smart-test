<?php

namespace App\Console\Models;

use App\Console\Models\PathCollection;

class VisitorLogReader
{
    /**
     * Delimeter used in log file.
     */
    const DELIMETER = ' ';

    /**
     * Value mapping in log file.
     */
    const MAP = [
        'path' => 0,
        'ip' => 1
    ];

    /**
     * @param string $filePath
     * @return PathCollection
     */
    public static function parseData(string $filePath) :PathCollection
    {
        $pathCollection = new PathCollection;
        if ($fh = fopen($filePath, 'r')) {
            while (!feof($fh)) {
                $line = fgets($fh);
                if ('' === trim($line)) {
                    continue;
                }
                $lineData = explode(self::DELIMETER, $line);
                $path =  $lineData[self::MAP['path']] ;
                $ip = $lineData[self::MAP['ip']];
                $model = new Path($path, [$ip]);
                $pathCollection ->addPath($model);
            }
            fclose($fh);
        }
        return $pathCollection;
    }
}
