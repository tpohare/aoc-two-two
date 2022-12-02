<?php

require_once "../functions.php";

class GameRules {
    private $A = "rock",
            $B = "paper",
            $C = "scissors",
            $X = "rock",
            $Y = "paper",
            $Z = "scissors";
    private $game_points;

    public function __construct()
    {
        $rock_score = 1;
        $paper_score = 2;
        $scissors_score = 3;
        $win_score = 6;
        $loss_score = 0;
        $draw_score = 3;

        $this -> game_points = [//You throw Rock
            'rock' => [// I throw
                'rock' => $rock_score + $draw_score, // Draw
                'paper' => $paper_score + $win_score, // Paper covers rock
                'scissors' => $scissors_score + $loss_score, // Rock blunts scissors
            ],
            //You throw Paper
            'paper' => [// I throw
                'rock' => $rock_score + $loss_score, // Paper covers rock
                'paper' => $paper_score + $draw_score, // Draw
                'scissors' => $scissors_score + $win_score, // Scissors cuts paper
            ],
            //You throw Scissors
            'scissors' => [// I throw
                'rock' => $rock_score + $win_score, // Paper covers rock
                'paper' => $paper_score + $loss_score, // Scissors cuts paper
                'scissors' => $scissors_score + $draw_score, // Draw],
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

        return $this -> game_points[$you][$me];
    }
}

$test_data = file_get_contents("input.txt");
$game_rules = new GameRules();
echo $game_rules -> totalScores($test_data, $game_rules);
