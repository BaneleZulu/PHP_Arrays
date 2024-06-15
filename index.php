<?php
$sharks = array('Itachi Uchiha', 'Gojo Saturo', 'Naruto Uzumaki', 'Sasuke Uchiha', 'Vegita');
$matches = array('Match Day1', 'Match Day2', 'Match Day3', 'Match Day4');
$total = $average = array();
$scores = [
    [61, 31, 71, 41],
    [50, 22, 60, 65],
    [17, 43, 66, 37],
    [41, 55, 54, 39],
    [41, 61, 40, 20]
];

__caller();
function __caller()
{
    //?This is a dummy function, but not a dummy function, it will all all other functions, since it will receive the 
    //?global  variables and will be able to call all other functions and pass them accordingly..
    __findTotal();
    __findAverage();
    __findAverage();
    echo "<p style='color:green';>" .   __findBestPerformer() . "</p>";
    $matchTotal = __findTotalForMatch();
    __display($matchTotal);
    __search("gojo");
}
//?This function is used  to calculate the total score of each shark player.
function __findTotal()
{
    //?These are global variables to use in this function, [$average is not needed here]
    global $sharks, $matches, $scores, $total;
    $sum = 0;
    for ($r = 0; $r < count($sharks); $r++) {
        for ($c = 0; $c < count($matches); $c++) {
            (int)$sum += $scores[$r][$c];
        }
        $total[] = $sum;
        $sum = 0; //?Return  the sum to zero for the next iteration.
    }
}
//?This function is used to calculate the average score of each shark player.
//?The average is calculated by  dividing the total score by the number of matches.
function __findAverage()
{
    global $sharks, $total, $average;
    for ($x = 0; $x < count($sharks); $x++) {
        $average[] = $total[$x] / count($sharks);
    }
}
//?This function is to determine the player with the highest number of points for any match.
function __findBestPerformer()
{
    global $sharks, $matches, $scores;
    $name = $match = null;
    $total_points = 0;

    for ($r = 0; $r < count($sharks); $r++) {
        for ($c = 0; $c < count($matches); $c++) {
            if ($total_points < $scores[$r][$c]) {
                $name = $sharks[$r];
                $match = $matches[$c];
                $total_points = $scores[$r][$c];
                // break (2);
            }
        }
    }
    return "The best performer is {$name}, with the highest score of {$total_points} points, obtained on {$match} ";
}

function __findTotalForMatch()
{
    global $sharks, $matches, $scores;
    $matchTotal = array();
    $sum = 0;
    for ($c = 0; $c < count($matches); $c++) {
        for ($r = 0; $r < count($sharks); $r++) {
            (int)$sum += $scores[$r][$c];
        }
        $matchTotal[] = $sum;
    }
    return $matchTotal;
}


//?This function is used to display the results in a table format.
function __display($matchTotal)
{
    global $sharks, $matches, $scores, $total, $average;
    $total_ttl = $total_avg = 0;
    echo "<table style='margin-left:400px';>";
    echo "<thead>";
    echo "<tr style='background-color:#ccc';>";
    echo "<th style='padding-inline:50px';>Player </th><th style='padding-inline:10px';>{$matches[0]}</th><th style='padding-inline:10px';>{$matches[1]}</th><th style='padding-inline:10px';>{$matches[2]}</th style='padding-inline:10px';><th style='padding-inline:10px';>{$matches[3]}</th><th style='padding-inline:10px';>Total Points</th><th>Average Pnt</th>";
    echo "</tr>";
    echo "</thead>";

    for ($r = 0; $r < count($sharks); $r++) {
        echo "<tr>";
        echo "<td>{$sharks[$r]}</td>";
        for ($c = 0; $c < count($matches); $c++) {
            echo "<td style='text-align:center';>{$scores[$r][$c]}</td>";
        }
        echo "<td style='text-align: right';>{$total[$r]}</td>";
        echo "<td style='text-align: right';>{$average[$r]}</td>";
        (int)$total_ttl += $total[$r];
        (int)$total_avg += $average[$r];
        echo "</tr>";
    }
    echo "<tr style='background-color: #eee';><td style='font-weight:bold';>Match Total</td><td style='text-align:center';>{$matchTotal[0]}</td><td style='text-align:center';>{$matchTotal[1]}</td><td style='text-align:center';>{$matchTotal[2]}</td><td style='text-align:center';>{$matchTotal[3]}</td> <td style='text-align:right';>{$total_ttl}</td><td style='text-align:right';>{$total_avg}</td></tr>";
    echo "</table>";
}

function __search($player)
{
    global $sharks, $total, $average;
    $player = strtolower($player);
    $flag = 0;
    for ($x = 0; $x < count($sharks); $x++) {
        if (str_contains(strtolower($sharks[$x]), $player)) {
            $player = strtoupper($player);
            echo "<h4 style='color:green'; >Player found [{$sharks[$x]}]</h4>";
            $flag = 1;
            $player = $sharks[$x];
            $player = strtoupper($player);
            break;
        } else {
            $flag = 0;
        }
    }
    switch ($flag) {
        case 1:
            echo "<table style='background-color: #eee';>";
            echo "<thead>";
            echo "<tr>";
            echo "<td style='padding-inline: 15px';>PLAYER</td><td style='padding-inline: 15px';>TOTAL POINTS</td><td style='padding-inline: 15px';>AVG POINTS</td>";
            echo "</tr>";
            echo "</thead>";
            echo "<tr style='background-color: #fff';>";
            echo "<td style='text-align: center';>{$player}</td> <td style='text-align: center';>{$total[$x]}</td><td style='text-align: center';>{$average[$x]}</td>";
            echo "</tr>";
            echo "</table>";
            break;
        case 0:
            echo "<h4 style='color:orange'; >Player NOT found [{$player}]</h4>";
            break;
        default:
            echo "<h4 style='color:red';>ERROR............<h4/>";
            break;
    }
}
