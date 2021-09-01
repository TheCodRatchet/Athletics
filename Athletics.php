<?php

$playerCount = (int)readline("Register player amount: ");
while ($playerCount > 8 || $playerCount < 2) {
    echo "2-8 players allowed to participate in race!" . PHP_EOL;
    $playerCount = (int)readline("Register player amount: ");
}

function randomGen(int $min, int $max, int $quantity): array
{
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}

$playerNumber = randomGen(1, 99, $playerCount);
$track = [];

function drawTrack($lanes)
{
    foreach ($lanes as $lane) {
        foreach ($lane as $sector) {
            echo "$sector ";
        }
        echo PHP_EOL;
    }
    echo "___________________________" . PHP_EOL;
}

$position = [0];

for ($i = 0; $i < $playerCount; $i++) {
    $position[$i] = 0;
}

$finish = [];

while (count(array_unique(($finish))) != $playerCount) {
        for ($c = 0; $c < $playerCount; $c++) {
            $track[$c] = array_fill(0, 11, "_");
            if ($position[$c] >= 10) {
                $track[$c][10] = $playerNumber[$c];
            } else {
                $track[$c][$position[$c]] = $playerNumber[$c];
                $position[$c] += rand(1, 2);
            }
        }
        foreach ($track as $lane) {
            if ($lane[10] !== "_") {
                $finish[] = $lane[10];
            }
        }
        drawTrack($track);
        sleep(1);
}

$places = array_values(array_unique($finish));

foreach ($places as $place => $number){
    echo "Player NR.$number has taken: " . ($place + 1) . ". place" . PHP_EOL;
}