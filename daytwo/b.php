<?php

require_once "../functions.php";

class GameRules {
    private $A = "rock",
            $B = "paper",
            $C = "scissors",
            $Z = "win",
            $X = "lose",
            $Y = "draw";
    private $predertimed_results;

    public function __construct()
    {
        $rock_score = 1;
        $paper_score = 2;
        $scissors_score = 3;
        $win_score = 6;
        $loss_score = 0;
        $draw_score = 3;

        $this -> predertimed_results = [
            //You throw Rock
            'rock' => [// I want to...
                'win' => $paper_score + $win_score, // Rock covered by Paper
                'lose' => $scissors_score + $loss_score, // Rock blunts scissors
                'draw' => $rock_score + $draw_score, // Draw
            ],
            //You throw Paper
            'paper' => [// I want to...
                'win' => $scissors_score + $win_score, // Paper cut by scissors
                'lose' => $rock_score + $loss_score, // Paper covers rock
                'draw' => $paper_score + $draw_score, // Draw
            ],
            //You throw Scissors
            'scissors' => [// I want to...
                'win' => $rock_score + $win_score, // Scissors blunted by rock
                'lose' => $paper_score + $loss_score, // Scissors cuts paper
                'draw' => $scissors_score + $draw_score, // Draw],
            ]
        ];
    }

    public function totalScores($input, $_this) {
        return array_reduce(explode("\n", $input), static function($running_total, $game_result) use ($_this) {
            return $running_total + $_this -> calculateScore($game_result);
        });
    }

    private function calculateScore($game_result) {
        $result = explode(" ", $game_result);
        $you = $this -> {$result[0]};
        $me = $this -> {$result[1]};

        return $this -> predertimed_results[$you][$me];
    }
}

$test_data = file_get_contents("input.txt");
$game_rules = new GameRules();
echo $game_rules -> totalScores($test_data, $game_rules);