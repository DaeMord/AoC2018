<?
if ($fh = fopen('input.txt', 'r')) {
    while (!feof($fh)) {
        $line = fgets($fh);
        echo $line;
        echo "   ";
        $runningTotal = $runningTotal + $line;
        echo $runningTotal;
        echo ("<br>");
    }
    fclose($fh);
}
?>
