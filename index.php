<?

function comparediff($string1, $string2,$count=true) {


    $output = 0;
    $answer = null;

    for ($string1count = 0; $string1count < strlen($string1); $string1count++) {
        $str1array[] = substr($string1,$string1count,1);
    }

    for ($string2count = 0; $string2count < strlen($string2); $string2count++) {
        $str2array[] = substr($string2,$string2count,1);
    }

    foreach ($str1array as $key => $value) {
        if ($value != $str2array[$key]){
            $output = $output + 1;
        } else {
            $answer = $answer . $value;
        }
    }

    if ($count) {
        return $output;
    } else {
        return $answer;
    }

}

$runningTotal = 0;
$loopcount = 0;
$line = array();
if ($fh = fopen('input2.txt', 'r')) {
    while (!feof($fh)) {
        $input = fgets($fh);
        $line[] = $input;
        $runningTotal = $runningTotal + $line[$loopcount];
        $loopcount = $loopcount + 1;
    }
    fclose($fh);
}

$counttotal = null;
$valuetocheck = null;
$counttotal = array();

for ($loopcheck = 0; $loopcheck < $loopcount; $loopcheck++) {
    $countarray = null;
    $countarray = array();

    for ($pointbypoint = 0; $pointbypoint < strlen($line[$loopcheck]); $pointbypoint++) {
        $countarray[] = substr($line[$loopcheck],$pointbypoint,1);
    }

    for ($comparecheck = 0;$comparecheck < $loopcount; $comparecheck++) {
        if ($loopcheck != $comparecheck) {
            $valuediff = comparediff($line[$loopcheck], $line[$comparecheck]);
            $answerdiff = comparediff($line[$loopcheck], $line[$comparecheck],false);
            if ($valuediff < 2) {
                $answer4 = $answerdiff;
            }
        }
    }

    $dupcount = array_count_values($countarray);

    $tobeentered = null;
    $tobeentered = array();
    foreach ($dupcount as $key => $value) {
        if ($value > 1) {
            $tobeentered[$value] = 1;
        }
    }

    foreach ($tobeentered as $key => $value) {
        $counttotal[$key] = $counttotal[$key] + 1;
    }

}
$finalanswer = 1;
foreach ($counttotal as $key => $value) {
    $finalanswer = $finalanswer * $value;
}

$answer3 = $finalanswer;

echo $answer3;
echo "<br>";
echo $answer4;

?>
