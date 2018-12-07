<?

$data = array();
if ($fh = fopen('input7.txt', 'r')) {
    while (!feof($fh)) {
        preg_match_all('/( . )/',fgets($fh),$output);
        $data[] = array(trim($output[0][0]),trim($output[0][1]));
        $loopcount = $loopcount + 1;
    }
    fclose($fh);
}


//Guess #1 TBRGNPXWFHMVOCIKULQJZAYDSE
//Guess #2 BTGNRFPWXHMVOCIKULQJZADYSE
//Guess #3 BTRFWXGINZKUHPMLQVOYJACDSE
//Guess #4 BTFRWXGINZKUHPMLQVOYJACDSE


foreach ($data as $key=>$value){
    if(!isset($entry[$value[0]])&&!isset($entry[$value[1]])) {
        $entry[$value[0]]=1;
        $entry[$value[1]]=$loopcount;
    } elseif (!isset($entry[$value[0]])&&isset($entry[$value[1]])) {
        $entry[$value[0]]=1;
        $entry[$value[1]] = $entry[$value[1]] + 1;
    } elseif (isset($entry[$value[0]])&&!isset($entry[$value[1]])) {
        $entry[$value[1]]=$loopcount;
        $entry[$value[0]] = $entry[$value[0]] - 1;
    } elseif (isset($entry[$value[0]])&&isset($entry[$value[1]])) {
        $entry[$value[0]] = $entry[$value[0]] - 1;
        $entry[$value[1]] = $entry[$value[1]] + 1;
    } elseif ($entry[$value[0]] > $entry[$value[1]]){
        $entry[$value[0]] = $entry[$value[0]] - 1;
        $entry[$value[1]] = $entry[$value[1]] + 1;
    }
}


$loop = 0;
foreach (range(A,Z)as $i) {
    $loop = $loop + 1;
    $entry1[$i] = $loop;
    $final = $final . $i;
}


$invalid = 1;

while($invalid == 1) {
    $invalid = 0;
    foreach ($data as $key => $value) {
        $position = strpos($final, $value[0]);
        $position1 = strpos($final, $value[1]);
        if ($position < $position1) {
            $checked = "Valid";
        } else {
            $checked = "INVALID--" . $value[0] . "x" . $value[1];
            $entry1[$value[0]] = $position1 + 1;
            $entry1[$value[1]] = $position + 1;
            $final = substr($final,0,$position1).substr($final,$position,1).substr($final,$position1+1,$position-$position1-1).substr($final,$position1,1).substr($final,$position+1);
            $invalid = 1;
            break;
        }
    }
}

$final = null;
$array_keys = array_keys($entry1);
array_multisort($entry1, $array_keys);
$entry1 = array_combine($array_keys, $entry1);

foreach ($entry1 as $key=>$value) {
    echo $key."..".$value."..".$entry[$key];
    echo "<br>";
    $final = $final.$key;
}
echo $final;

?>
