<?php

require_once "../functions.php";

function totalScores($input) {
    return array_reduce($input, static function($running_total, $game_result) {
        return $running_total + match($game_result) {
            //X = 1 Points
            //Y = 2 Points
            //Z = 3 Points
            //Win = 6 Points
            //Draw = 3 Points
            //Loss = 0 Points
            // Them vs You
            'A X' => 4, // Rock vs Rock = Draw.
            'A Y' => 8, // Rock vs Paper = Win. Paper covers Rock.
            'A Z' => 3, // Rock vs Scissors = Loss. Rock blunts Scissors.
            'B X' => 1, // Paper vs Rock. Loss. Paper covers Rock.
            'B Y' => 5, // Paper vs Paper = Draw.
            'B Z' => 9, // Paper vs Scissors = Win. Scissors cuts Paper.
            'C X' => 7, // Scissors vs Rock = Win. Rock blunts Scissors.
            'C Y' => 2, // Scissors vs Paper = Loss. Scissors cuts Paper.
            'C Z' => 6, // Scissors vs Scissors = Draw.
        };
    });
}

$test_data = explode("\n", file_get_contents("input.txt")); ;
$total = totalScores($test_data);

echo check($total, 14163);
