<?php

require_once "../functions.php";

class GameRules {
    private $A = "rock",
            $B = "paper",
            $C = "scissors",
            $Z = "win",
            $X = "lose",
            $Y = "draw";

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
        return $this -> predeterminedResults(
            sprintf("%s|%s", $this -> {$game_result[0]}, $this -> {$game_result[2]})
        );
    }

    private function predeterminedResults($result) {
        return match($result) {
            'rock|win'      => $this -> paper_score     + $this -> win_score, // Rock covered by Paper
            'rock|lose'     => $this -> scissors_score  + $this -> loss_score, // Rock blunts scissors
            'rock|draw'     => $this -> rock_score      + $this -> draw_score, // Draw
            'paper|win'     => $this -> scissors_score  + $this -> win_score, // Paper cut by scissors
            'paper|lose'    => $this -> rock_score      + $this -> loss_score, // Paper covers rock
            'paper|draw'    => $this -> paper_score     + $this -> draw_score, // Draw
            'scissors|win'  => $this -> rock_score      + $this -> win_score, // Scissors blunted by rock
            'scissors|lose' => $this -> paper_score     + $this -> loss_score, // Scissors cuts paper
            'scissors|draw' => $this -> scissors_score  + $this -> draw_score, // Draw,
        };
    }
}

$test_data = file_get_contents("input.txt");
$game_rules = new GameRules();
$total = $game_rules -> totalScores($test_data, $game_rules);

echo check($total, 12091);
