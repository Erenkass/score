
<?php


$firstTeam = "Fenerbahçe";
$secondTeam = "Slovaçka";
$firstTeamPlayers=[
    [
        "name"=>"altay",
        "goalchance"=>1,
    ],
    [
        "name"=>"ferdi",
        "goalchance"=>10,
    ],
    [
        "name"=>"Arda",
        "goalchance"=>50,
    ],
    [
        "name"=>"Vanlencia",
        "goalchance"=>60,
    ]

];
$secondTeamPlayers=[
    [
        "name"=>"kal",
        "goalchance"=>1,
    ],
    [
        "name"=>"Kadlec",
        "goalchance"=>5,
    ],
    [
        "name"=>"Havlik",
        "goalchance"=>25,
    ],
    [
        "name"=>"forv",
        "goalchance"=>45,
    ]

];
$firstPower=0;
$secondPower=0;

$last = 0;

foreach ($firstTeamPlayers as $i=>$player1) {
    $firstPower += $player1['goalchance'];
    $firstTeamPlayers[$i]["rate"] = [$last+1, $firstPower];
    $last = $firstPower;
}

$last = 0;

foreach ($secondTeamPlayers as $i => $player2) {
    $secondPower += $player2['goalchance'];
    $secondTeamPlayers[$i]["rate"] = [$last+1, $secondPower];
    $last = $secondPower;
}

$matchTime = 90;
$goalRate = 3;

$score = [0,0];

for($i=1;$i<=$matchTime;$i++) {
    $goalRand = rand(1, 100);

    // gol olma ihtimali
    if ($goalRand <= $goalRate) {
        $teamRand = rand(1, $firstPower + $secondPower);

        if ($teamRand <= $firstPower) {
            $score[0]++;
            $playerRand = rand(1, $firstPower);


            foreach ($firstTeamPlayers as $player1) {
                if($player1["rate"][0]<=$playerRand && $playerRand <= $player1["rate"][1]) {
                    $playerName = $player1["name"];
                    break;
                }
            }


            echo $i . ".dk " . $firstTeam . " gol attı. (".$playerName.") <br>";

        } else {
            $score[1]++;

            $playerRand = rand(1, $secondPower);


            foreach ($secondTeamPlayers as $player2) {

                if($player2["rate"][0]<=$playerRand && $playerRand <= $player2["rate"][1]) {
                    $playerName = $player2["name"];
                    break;
                }
            }


            echo $i . ".dk " . $secondTeam . " gol attı. (".$playerName.") <br>";


        }
    }
}


echo "<h3> SKOR : ".$score[0] ." - ".$score[1]."</h3>";

