<?php

namespace App\Test\Unit;

use PHPUnit\Framework\TestCase;
use App\Console\Models\Path;

class PathTest extends TestCase
{
    /**
     * @var Path
     */
    private $path;

    private $pathName = 'test/path';
    private $ips = ['336.284.013.698','336.284.013.698','336.284.013.698', '123.456.789.100'];

    protected function setUp() :void
    {
        $this->path = new Path(
            $this->pathName,
            $this->ips
        );
    }

    /**
     * Test getAddIps() method.
     *
     * @return void
     * @dataProvider addIpsDataProvider
     */
    public function testAddIps($ips, $count)
    {
        $path = $this->path->addIps($ips);
        $countIps = count($path->getIps());
        $this->assertEquals($count, $countIps);
    }

    /**
     * @return array
     */
    public function addIpsDataProvider()
    {
        return [
            [['336.284.013.698','336.284.013.698','336.284.013.698'], 7],
            [[], count($this->ips)],
        ];
    }

    /**
     * Test getViews() method.
     *
     * @return void
     */
    public function testGetViews()
    {
        $actualResult = $this->path->getViews();
        $this->assertEquals(4, $actualResult);
    }

    /**
     * Test getUniqueViews() method.
     *
     * @return void
     */
    public function testGetUniqueViews()
    {
        $actualResult = $this->path->getUniqueViews();
        $this->assertEquals(2, $actualResult);
    }
}
