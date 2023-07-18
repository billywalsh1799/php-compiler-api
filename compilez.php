<?php



echo "hello php compiler\n";

$output=array();
$returnValue = '';
$timeLimitPerCase = 2;
//$command=sprintf('python test.py "%s" "%s" 2>&1',"al pacino","deniro");
//$command=sprintf('python test.py "%s" "%s"',"al pacino","deniro");
//exec($command, $output, $returnValue);
$stdoutFile = 'stdout.txt';
$stderrFile = 'stderr.txt';
$command=sprintf('python test.py "%s" "%s" 2> stderr.txt',"al pacino","deniro");
//exec("python test.py ".' 2> ' . $stderrFile,$output,$returnValue);
set_time_limit($timeLimitPerCase);
exec($command,$output,$returnValue);
if ($returnValue === 0) {
    echo "Compilation successful\n";
} else {
    echo "Compilation failed\n";
}


//exec("python test.py", $output, $returnValue);
foreach ($output as $value) {
    echo "$value,";
}

//echo "typeof output: ".gettype($output);

?>