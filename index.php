<?

$loopcount = 0;
$data = array();
if ($fh = fopen('input4.txt', 'r')) {
    while (!feof($fh)) {
        $input = fgets($fh);
        $data[] = $input;
        $loopcount = $loopcount + 1;
    }
    fclose($fh);
}

//date = number of seconds
//60=1min
//3600=1hour
//86400=1day


foreach ($data as $key => $value){
    $output = usefuldata($value);
    $date = strtotime($output[0]);
    $dataarray[$date] = array($output[1],$output[2],$output[3]);
    $guardnumber[] = $output[1];
}

ksort($dataarray);


//foreach ($dataarray as $key => $value){
//    echo $key . "--".$value[0]."--".$value[1]."--".$value[2];
//    echo "<br>";
//}


$guardnumber = array_filter(array_unique($guardnumber));
//$guardnumber = array(73);

foreach ($guardnumber as $key => $value){
    $sleepytime = 0;
    $timeasleep = 0;
    //$mostasleep = 0;
    for ($min = 0;$min < 60;$min++) {
        //echo $value."--".$min;
        //echo "<br>";
        $asleepcount = guardisasleep($dataarray, $value, $min);
     //   $runningcount = $runningcount + $asleepcount;
        $sleepytime = $sleepytime + $asleepcount;
        if($asleepcount > $timeasleep) {
            $timeasleep = $asleepcount;
            $timetime = $min;
        }
        if ($asleepcount > $mostsleepycount) {
            //echo $value."--".$asleepcount."--".$min;
            //echo "<br>";
            $mostsleepycount = $asleepcount;
            $mostsleepyguard = $value;
            $mostsleepymin = $min;
        }

    }
    //echo $value."--".$sleepytime."--".$mostasleep;
    //echo "<br>";
    if ($sleepytime > $mostasleep) {
        //echo $value . "was asleep for" .$sleepytime."at".$timetime;
        //echo "<br>";
        $mostasleep = $sleepytime;
        $answer7 = $value * $timetime;
    }
}

$answer8 = $mostsleepyguard * $mostsleepymin;
//echo $mostsleepyguard."--".$mostsleepymin;
echo $answer7;
echo "<br>";
echo $answer8;


function usefuldata($input) {
    for ($dataloop = 0; $dataloop < strlen($input);$dataloop++) {
        $dataarray[] = substr($input,$dataloop,1);
    }

    foreach ($dataarray as $key => $value) {
        switch($value) {
            case "[":
                for($searchloop = $searchcount + 1; $searchvalue != "]"; $searchloop++) {
                    $searchvalue = substr($input,$searchloop,1);
                    $datedata = $datedata . $searchvalue;
                }
                break;
            case "#":
                for($searchloop = $searchcount + 1; $searchvalue != " "; $searchloop++) {
                    $searchvalue = substr($input,$searchloop,1);
                    $guardnumber = $guardnumber . $searchvalue;
                }
                break;
            case "l":
                $asleep = 1;
                break;
            case "w":
                $awake = 1;
                break;
        }
        $searchcount = $searchcount + 1;
    }

    $datedata = substr($datedata,0,strlen($datedata)-1);
    $guardnumber = substr($guardnumber,0,strlen($guardnumber)-1);

    $outarray = array($datedata,$guardnumber,$awake,$asleep);

    return $outarray;
}

function guardisasleep($inputarray, $guardnumber, $isasleep) {

    $datetimeawake = null;
    $datetimeasleep = null;
    $retval = null;

    foreach ($inputarray as $key => $value) {
        $loopcount = $loopcount + 1;
        //$date = date('d/M/Y H:i:s', $key);
        if ($guardnumber==$value[0]) {
            $guardfound = $value[0];
            $datetimeawake = null;
            $datetimeasleep = null;
        }
        if ($value[0]>0 && $guardnumber!=$value[0]) {
            $guardfound = $value[0];
        }
        if ($value[1]=="1") {
            $datetimeawake = $key;
            $awake = 0;
        }
        if ($value[2]=="1") {
            $datetimeasleep = $key;
            $datetimeawake = null;
            $awake = 1;
        }

        $datea = intval(date('i', $datetimeawake));
        $dateb = intval(date('i', $datetimeasleep));
        $datefulla = date('d/M/Y H:i:s', $datetimeawake);
        $datefullb = date('d/M/Y H:i:s', $datetimeasleep);


        if ($guardfound == $guardnumber && isset($datetimeasleep)  && isset($datetimeawake)) {
            if($dateb<=$isasleep && $isasleep<$datea) {
                $retval = $retval + 1;
                //echo $retval."--" .$datefullb."--".$datefulla;
                //echo "<br>";
            }
        }

    }
    return $retval;


}



?>
