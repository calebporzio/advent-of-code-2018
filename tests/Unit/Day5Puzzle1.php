<?php

namespace Tests\Unit;

use Illuminate\Support\Collection;
use Tests\TestCase;

class Day5Puzzle1 extends TestCase
{
    public function test()
    {
        ini_set('xdebug.max_nesting_level', 9999999);
        ini_set('memory_limit', '1024M');

        $initialString = $this->input();

        $this->assertEquals(9808, strlen($this->evaluateOneReaction($initialString, $start = 1)));
    }

    public function evaluateOneReaction($string, $start)
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
