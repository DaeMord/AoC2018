<?

$data = array();
if ($fh = fopen('input7test.txt', 'r')) {
    while (!feof($fh)) {
        //$data[] = preg_match('/( . )/g',fgets($fh));
        $data[] = fgets($fh);
        //$strip = preg_split("/,/",fgets($fh));
        //$data[] = array(intval($strip[0]),intval($strip[1]));
        //$maxx = max($maxx,intval($strip[0]));
        //$maxy = max($maxy,intval($strip[1]));
    }
    fclose($fh);
}



foreach ($data as $key=>$value){
    echo $value;
    preg_match('/ . /g',$value,$output);
    echo $output;
    echo "<br>";
}

?>
