<?
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

//$line = null;
//$line = array("abcdef","bababc","abbcde","abcccd","aabcdd","abcdee","ababab");
//$loopcount = 7;
$counttotal = null;
$counttotal = array();

for ($loopcheck = 0; $loopcheck < $loopcount; $loopcheck++) {
    $countarray = null;
    $countarray = array();

    for ($pointbypoint = 0; $pointbypoint < strlen($line[$loopcheck]); $pointbypoint++) {
        $countarray[] = substr($line[$loopcheck],$pointbypoint,1);
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
        //echo "$key = $value ";
        $counttotal[$key] = $counttotal[$key] + 1;
    }

    //foreach ($counttotal as $key => $value) {
        //echo "$key = $value ";
    //}

        //echo serialize($dupcount);
        //echo count($dupcount);
        //echo " ";

        //echo " ";
        //echo $line[$loopcheck];
        //echo "<br>";
}
$finalanswer = 1;
foreach ($counttotal as $key => $value) {
    //echo "$key = $value ";
    $finalanswer = $finalanswer * $value;
    //echo $finalanswer;
    //echo "<br>";
}

$answer3 = $finalanswer;

echo $answer3;

?>
