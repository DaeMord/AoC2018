<?

$loopcount = 0;
$data = array();
if ($fh = fopen('input3.txt', 'r')) {
    while (!feof($fh)) {
        $input = fgets($fh);
        $data[] = $input;
        $loopcount = $loopcount + 1;
    }
    fclose($fh);
}

// Test data entry
//$data = null;
//$data = array("#1 @ 1,3: 4x4","#2 @ 3,1: 4x4","#3 @ 5,5: 2x2");
//$loopcount = 1;


//Main loop

for ($loopcheck = 0; $loopcheck < $loopcount; $loopcheck++) {
    $i = dataextract($data[$loopcheck]);
    for ($inputxloop = 0; $inputxloop < $i[3]; $inputxloop++) {
        for ($inputyloop = 0; $inputyloop < $i[4]; $inputyloop++) {
            $inputxyarray[$i[1]+$inputxloop][$i[2]+$inputyloop] = $inputxyarray[$i[1]+$inputxloop][$i[2]+$inputyloop] + 1;
            if ($sizex < $i[1] + $inputxloop) {
                $sizex = $i[1] + $inputxloop;
            }
            if ($sizey < $i[2] + $inputyloop) {
                $sizey = $i[2] + $inputyloop;
            }
        }
    }
}

$fabriccount = null;

for ($yloop = 0; $yloop < $sizey+1; $yloop++) {
    for ($xloop = 0; $xloop < $sizex+1; $xloop++){
        if ($inputxyarray[$xloop][$yloop]>1) {
            $fabriccount = $fabriccount + 1;
        }
    }
}


for ($loopcheck = 0; $loopcheck < $loopcount; $loopcheck++) {
    $lookfor = dataextract($data[$loopcheck]);
    $entry[$lookfor[0]] = 0;
    for ($inputxloop = 0; $inputxloop < $lookfor[3]; $inputxloop++) {
        for ($inputyloop = 0; $inputyloop < $lookfor[4]; $inputyloop++) {
            if ($inputxyarray[$lookfor[1]+$inputxloop][$lookfor[2]+$inputyloop] > $entry[$lookfor[0]]) {
                $entry[$lookfor[0]] = $inputxyarray[$lookfor[1]+$inputxloop][$lookfor[2]+$inputyloop];
            }
        }
    }
}

foreach ($entry as $key => $value) {
    if ($value<2){
        $answer6 = $key;
    }
}

$answer5 = $fabriccount;

echo $answer5;
echo "<br>";
echo $answer6;




/**
 * @param $input
 *
 * @return mixed
 * 0 = #
 * 1 = start x
 * 2 = start y
 * 3 = length x
 * 4 = length y
 */

function dataextract($input) {

    for ($dataloop = 0; $dataloop < strlen($input);$dataloop++) {
        $dataarray[] = substr($input,$dataloop,1);
    }

    $searchcount = 0;

    foreach ($dataarray as $key => $value) {
        switch ($value) {
            case "#":
                for($searchloop = $searchcount + 1; $searchvalue != " "; $searchloop++) {
                    $searchvalue = substr($input,$searchloop,1);
                    $hashdata = $hashdata . $searchvalue;
                }
                break;
            case "@":
                for($searchloop = $searchcount + 1; $searchvalue != ","; $searchloop++) {
                    $searchvalue = substr($input,$searchloop,1);
                    $figure1 = $figure1 . $searchvalue;
                }
                break;
            case ",":
                for($searchloop = $searchcount + 1; $searchvalue != ":"; $searchloop++) {
                    $searchvalue = substr($input,$searchloop,1);
                    $figure2 = $figure2 . $searchvalue;
                }
                break;
            case ":":
                for($searchloop = $searchcount + 1; $searchvalue != "x"; $searchloop++) {
                    $searchvalue = substr($input,$searchloop,1);
                    $figure3 = $figure3 . $searchvalue;
                }
                break;
            case "x":
                for($searchloop = $searchcount + 1; $searchloop<strlen($input); $searchloop++) {
                    $searchvalue = substr($input,$searchloop,1);
                    $figure4 = $figure4 . $searchvalue;
                }
                break;

        }
        $searchcount = $searchcount + 1;
    }


    //convert all to numbers
    $hashdata = intval($hashdata);
    $figure1 = intval(substr($figure1,0,strlen($figure1)-1));
    $figure2 = intval(substr($figure2,0,strlen($figure2)-1));
    $figure3 = intval(substr($figure3,0,strlen($figure3)-1));
    $figure4 = intval($figure4);



    $newdataarray = array($hashdata,$figure1,$figure2,$figure3,$figure4);


    return $newdataarray;
}




?>
