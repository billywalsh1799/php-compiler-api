<?php


echo"hello";
$pythonFile="test2.py";
$arg1 = "al pacino";
$arg2 = "robert deniro";
$arg3 = "brad pitt";
$command = "python $pythonFile " . escapeshellarg($arg1) . " " . escapeshellarg($arg2) . " " . escapeshellarg($arg3);
$output=shell_exec($command);
echo "output:$output";

?>