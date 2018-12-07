<?php

namespace Tests\Unit;

use Illuminate\Support\Collection;
use Tests\TestCase;

class Day5Puzzle2 extends TestCase
{
    public function test()
    {
        ini_set('xdebug.max_nesting_level', 9999999);
        ini_set('memory_limit', '1024M');

        $initialString = $this->input();

        $lower = 'abcdefghijklmnopqrstuvwxyz';
        $upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $results = [];

        for ($i=0; $i < 26; $i++) {
            $results[$lower[$i]] = strlen($this->evaluateOneReaction(
                preg_replace('/['.$lower[$i].$upper[$i].']/', '', $initialString)
            ));
        }

        asort($results);

        $this->assertEquals(6484, head($results));
    }

    public function evaluateOneReaction($string, $start = 1)
    {
        for ($i=$start; $i < strlen($string); $i++) {
            if (
                strtolower($string[$i]) === strtolower($string[$i - 1])
                && $string[$i] !== $string[$i - 1]
            ) {
                return $this->evaluateOneReaction(substr_replace($string, '', $i-1, 2), max($i-2, 1));
            }
        }

        return $string;
    }

    public function input()
    {
        // return 'abcdefghHA';
        return preg_replace('/\s*/m', '', file_get_contents(__DIR__ . '/Day5Puzzle1.txt'));
    }
}
