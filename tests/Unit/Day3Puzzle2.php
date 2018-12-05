<?php

namespace Tests\Unit;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class Day3Puzzle2 extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        Config::set(['database.connections.sqlite.database' => __DIR__ . '/Day3Puzzle1.sqlite']);
        DB::setDefaultConnection('sqlite');
    }

    public function test()
    {
        // I am so sorry.
        $this->assertEquals(695, DB::select(<<<EOT
SELECT * FROM (SELECT *, COUNT(uses) as 'solo_squares' FROM (SELECT id, x_and_y as 'point', COUNT(id) as 'uses' FROM 'points' GROUP BY x_and_y) as 'base' INNER JOIN (
	SELECT id, count(id) as 'points_in_rectangle' FROM 'points' GROUP BY id
) as 'joined' ON joined.id = base.id WHERE uses = 1
GROUP BY base.id) WHERE solo_squares = points_in_rectangle
EOT
        )[0]->id);
    }
}
