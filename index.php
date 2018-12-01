<?
$runningTotal = 0;
$loopcount = 0;
$line = array();
if ($fh = fopen('input.txt', 'r')) {
    while (!feof($fh)) {
        $input = intval(fgets($fh));
        $line[] = $input;
        $runningTotal = $runningTotal + $line[$loopcount];
        $runningArray[] = $runningTotal;
        $loopcount = $loopcount + 1;
    }
    fclose($fh);
}

$answer1 = $runningTotal;
$answer2 = null;

$loopcheck = 0;
$additionalloop = 0;
$loopcheck2 = 0;
$loopcntfinal = 1;

while (!$answer2) {
    while ($loopcheck < $loopcount) {
        $checknumber = $runningArray[$loopcheck] + ($answer1 * $loopcntfinal);
        echo "number to check against-";
        echo $checknumber;
        echo "<br>";
        while ($loopcheck2 < $loopcount) {
            $loopcheck2 = $loopcheck2 + 1;
            //echo $checknumber;
            //echo " ";
            //echo $runningArray[$loopcheck2];
            //echo "<br>";
            if ($checknumber == $runningArray[$loopcheck2]) {
                $answer2 = $checknumber;
                break 3;
            }
        }
        $loopcheck2 = 0;
        $loopcheck = $loopcheck + 1;
    }
    $loopcheck = 0;
    $loopcntfinal = $loopcntfinal + 1;
    echo $loopcntfinal;
    echo "<br>";
}

    echo "<br>";
    echo "Answer 1 -";
    echo $answer1;
    echo "<br>";
    echo "Answer 2 -";
    echo $answer2;


?>
