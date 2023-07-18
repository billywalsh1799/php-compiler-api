<?php

echo "command\n";
function prepare_command($language,$file,...$args) {
    
    $command="";
    $arguments=array();
    
    foreach ($args as $arg) {  
        array_push($arguments,'"' . $arg . '"');
    }
    $argumentString = implode(' ', $arguments);
    
    if($language=="python"){
        $pythonFile=$file;
        $command = "python $pythonFile $argumentString";
    }

    else if($language=="php"){
        $phpFile=$file;
        $command="php $phpFile $argumentString";
    }

    else if($language=="node"){
        $nodeFile=$file;
        $command="node $nodeFile $argumentString";
    }
    
    
    return $command;
  
}  

$py_command=prepare_command("python","test2.py","al pacino","robert deniro","brad pitt");
$php_command=prepare_command("php","test.php","al pacino","robert deniro","edward norton");
$node_command=prepare_command("node","test.js","francis ford copola","quenten tarentino");

$py_output=shell_exec($py_command);
$php_output=shell_exec($php_command);
$node_output=shell_exec($node_command);

echo"py_output:$py_output\n";
echo"php_output:$php_output\n";
echo"node_output:$node_output\n";
  


?>