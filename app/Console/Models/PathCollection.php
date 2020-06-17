<?php

namespace App\Console\Models;

use App\Console\Models\Path;

/**
 * This is NOT an Eloquent model by design
 */
class PathCollection
{
    /**
     * @var array
     */
    private $paths = [];

    /**
     * @param Path $path
     * @return void
     */
    public function addPath(Path $path) :void {
        $identifier = $path->getPath();
        $ips = $path->getIps();
        if (array_key_exists($identifier, $this->paths)) {
            $this->paths[$identifier]->addIps($ips);
        } else {
            $this->paths[$identifier] = $path;
        }
    }

    /**
     * @return array
     */
    public function getSortedPathsByViews() :array {
        $paths = $this->paths;
        usort(
            $paths,
            function($a, $b) {
                return $b->getViews() - $a->getViews();
            }
        );
        return $paths;
    }

    /**
     * @return array
     */
    public function getSortedPathsByUniqueViews() :array {
        $paths = $this->paths;
        usort(
            $paths,
            function($a, $b) {
                return $b->getUniqueViews() - $a->getUniqueViews();
            }
        );
        return $paths;
    }
}
