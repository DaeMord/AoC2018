<?

$data = array();
if ($fh = fopen('input6.txt', 'r')) {
    while (!feof($fh)) {
        $strip = preg_split("/,/",fgets($fh));
        $data[] = array(intval($strip[0]),intval($strip[1]));
        $maxx = max($maxx,intval($strip[0]));
        $maxy = max($maxy,intval($strip[1]));
    }
    fclose($fh);
}


//test data
/*
$data =array(
    "1, 1",
"1, 6",
"8, 3",
"3, 4",
"5, 5",
"8, 9"
);
$maxx=0;
$maxy=0;
foreach ($data as $key => $value) {
    $strip = preg_split("/,/",$value);
    $output[] = array(intval($strip[0]),intval($strip[1]));
    $maxx = max($maxx,intval($strip[0]));
    $maxy = max($maxy,intval($strip[1]));
}
$data = $output;


*/
//Test data end


function calcdist($input,$compare) {
    $x = $input[0];
    $y = $input[1];
    $x1 = $compare[0];
    $y1 = $compare[1];
    $dist = (max($x,$x1) - min($x,$x1)) + (max($y,$y1) - min($y,$y1));
    return $dist;
}

$minfound = PHP_INT_MAX;
$distcount = 0;
for ($x1 = 0;$x1<($maxx+1);$x1++){
    for ($y1 = 0;$y1<($maxy+1);$y1++){
        $xy = array($x1,$y1);
        foreach($data as $key=>$value) {
            $dist = calcdist($value,$xy);
            $x = $value[0];
            $y = $value[1];
            $distcount = $distcount + $dist;
            if ($minfound>$dist){
                $minfound = $dist;
                $outputarray[$y1][$x1] = $key;
            } elseif ($minfound==$dist){
                $outputarray[$y1][$x1] = ".";
            }
        }
        $outputcount[$outputarray[$y1][$x1]]=$outputcount[$outputarray[$y1][$x1]]+1;
        $newarray[$y1][$x1]=$distcount;
        $distcount = 0;
        $minfound = PHP_INT_MAX;
    }
}

$minfound = PHP_INT_MAX;
for ($x1 = -100;$x1<($maxx+100);$x1++){
    for ($y1 = -100;$y1<($maxy+100);$y1++){
        $xy = array($x1,$y1);
        foreach($data as $key=>$value) {
            $dist = calcdist($value,$xy);
            $x = $value[0];
            $y = $value[1];
            if ($minfound>$dist){
                $minfound = $dist;
                $outputarray1[$y1][$x1] = $key;
            } elseif ($minfound==$dist){
                $outputarray1[$y1][$x1] = ".";
            }
        }
        $outputcount1[$outputarray1[$y1][$x1]]=$outputcount1[$outputarray1[$y1][$x1]]+1;
        $minfound = PHP_INT_MAX;
    }
}

ksort($outputcount);
ksort($outputcount1);

foreach ($outputcount as $key=>$value) {
    if ($value==$outputcount1[$key]) {
        echo $key."--".$value."--".$outputcount1[$key];
        echo "<br>";
        $maxvalue = max($maxvalue,$value);
    }
}

echo $maxvalue;
echo "<br>";

foreach ($newarray as $keyx=>$valuex) {
    foreach ($valuex as $keyy=>$valuey) {
        if ($valuey<10000) {
            $valcount = $valcount +1;
        }
    }
}
echo $valcount;
echo "<br>";

?>
