<?php

echo "Hello World!\n";
//$output=shell_exec('python test.py');
$arg1="al pacino";$arg2="robert deniro";
//$output_with_args = shell_exec(sprintf('php test.php "%s" "%s" 2>&1', $arg1, $arg2));
//echo $output_with_args;  */
//shell_exec("javac main.java");

//$output=shell_exec(sprintf('java Main "%s" "%s" ', $arg1, $arg2));
$arguments = array($arg1, $arg2);
$command = 'python test2.py ' . implode(' ', $arguments);
$output=shell_exec($command);
echo $output;






?>