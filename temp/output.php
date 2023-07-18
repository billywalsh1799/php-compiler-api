<?php

echo "output file\n";
$file1 = 'output.txt';
$file2="expectedoutput.txt";

//check file exsistance
$output = file_get_contents($file1);
$expected_output=file_get_contents($file2);
//echo "content:\n$content";

//echo "expected:\n$expected_output";

if($output==$expected_output)
    echo"correct answer";
else
    echo "wrong answer";

$x="sam";
$y="same";
echo $x==$y;

?>