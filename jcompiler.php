<?php

echo "hello java compiler\n";
$output=array();
$returnValue = '';
exec("javac main.java");
$command=sprintf('java Main "%s" "%s" 2> stderr.txt',"al pacino","deniro");
exec($command,$output,$returnValue);
if ($returnValue === 0) {
    echo "Compilation successful\n";
} else {
    echo "Compilation failed\n";
}

foreach ($output as $value) {
    echo "$value,";
}


?>