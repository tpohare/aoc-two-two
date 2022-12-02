<?php

require_once "../functions.php";

class GameRules {
    private $A = "rock",
            $B = "paper",
            $C = "scissors",
            $X = "rock",
            $Y = "paper",
            $Z = "scissors";

    private $rock_score = 1,
            $paper_score = 2,
            $scissors_score = 3,
            $win_score = 6,
            $loss_score = 0,
            $draw_score = 3;

    public function totalScores($input, $_this) {
        return array_reduce(explode("\n", $input), static function($running_total, $game_result) use ($_this) {
            return $running_total + $_this -> calculateScore($game_result);
        });
    }

    private function calculateScore($game_result) {
        return $this -> scores(
            sprintf("%s|%s", $this -> {$game_result[0]}, $this -> {$game_result[2]})
        );
    }

    private function scores($result) {
        return match($result) {
            'rock|rock'         => $this -> rock_score      + $this -> draw_score, // Draw
            'rock|paper'        => $this -> paper_score     + $this -> win_score, // Paper covers rock
            'rock|scissors'     => $this -> scissors_score  + $this -> loss_score, // Scissors blunted by rock
            'paper|rock'        => $this -> rock_score      + $this -> loss_score, // Rock covered by paper
            'paper|paper'       => $this -> paper_score     + $this -> draw_score, // Draw
            'paper|scissors'    => $this -> scissors_score  + $this -> win_score, // Scissors cuts paper
            'scissors|rock'     => $this -> rock_score      + $this -> win_score, // Rocks blunts scissors
            'scissors|paper'    => $this -> paper_score     + $this -> loss_score, // Paper cut but scissor
            'scissors|scissors' => $this -> scissors_score  + $this -> draw_score, // Draw],
        };
    }
}

$test_data = file_get_contents("input.txt");
$game_rules = new GameRules();
$total = $game_rules -> totalScores($test_data, $game_rules);

echo check($total, 14163);
