<?php

namespace App\Console\Models;

/**
 * This is NOT an Eloquent model by design
 */
class Path
{
    const PATH_IDENTIFIER = 'path';
    const IPS = 'ips';

    /** Sortable attributes. */
    const VIEWS = 'views';
    const UNIQUE = 'unique';

    /**
     * @var string
     */
    private $path;

    /**
     * @var array
     */
    private $ips = [];

    /**
     * @param string $path
     * @param array $ips
     * @return void
     */
    public function __construct(string $path, array $ips)
    {
        $this->path = $path;
        $this->ips = $ips;
    }

    /**
     * @return string
     */
    public function getPath() :string {
        return $this->path;
    }

    /**
     * @return array
     */
    public function getIps() :array {
        return $this->ips;
    }

    /**
     * @param array $ips
     * @return Path
     */
    public function addIps(array $ips) :Path {
        $this->ips = array_merge($this->ips, $ips);
        return $this;
    }

    /**
     * @return int
     */
    public function getViews() :int {
        return count($this->ips);
    }

    /**
     * @return int
     */
    public function getUniqueViews() :int {
        return count(array_unique($this->ips));
    }
}
