<?php

echo "node compiler\n";
$nodeFile ="test.js";  // Replace with the actual path to your node file
// Multiple arguments to be passed
$arg1 = "al pacino";
$arg2 = "robert deniro";
$arg3 = "brad pitt";

//push arguments to an array
$arguments = array('"' . $arg1 . '"', '"' . $arg2 . '"', '"' . $arg3 . '"');

$argumentString = implode(' ', $arguments);

//Pepare command to execute script with arguments
//$executeCmd = "node $nodeFile " .implode(' ', $arguments);
$executeCmd = "node $nodeFile $argumentString";

// Concatenate the arguments with a delimiter
//$inputData = $arg1 . "|" . $arg2 . "|" . $arg3;


$executeDescriptorSpec = array(
    0 => array('pipe', 'r'),  // stdin
    1 => array('pipe', 'w'),  // stdout
    2 => array('pipe', 'w')   // stderr
);
$executeProcess = proc_open($executeCmd, $executeDescriptorSpec, $executePipes);

if (is_resource($executeProcess) && is_array($executePipes) && is_resource($executePipes[1])) {
    
    // Pass input data to the node script
    //fwrite($executePipes[0], $inputData);
    //fclose($executePipes[0]);  // Close stdin
    
    // Set the maximum execution time  for the process
    $maxExecutionTime =5;
    // Sleep for the desired duration
    //sleep($maxExecutionTime);
    $status = proc_get_status($executeProcess);
    //echo "before status:".proc_get_status($executeProcess)['running']."\n";
    $timeLimit=0;
    // Start the timer
    $startTime = time();
    while(proc_get_status($executeProcess)['running']){
        // Get the elapsed time
        $elapsedTime = time() - $startTime;
        if ($elapsedTime >= $maxExecutionTime){
            // Process is still running, terminate it
            $terminate_code=proc_terminate($executeProcess);
            // Additional handling for the termination
            // ...
            $timeLimit=1;
            echo "time limit exceeded\n";
            echo "terminate code:$terminate_code";
            //send TimeLimit

        }
    }
    
    //if time limit exceeded do not get stream contents

    if($timeLimit==0){
        //program executed whithin timelimit
        // Read and display the program's output
        $output= stream_get_contents($executePipes[1]);  // stdout
        $error= stream_get_contents($executePipes[2]);  // stderr

        echo "stdout:$output\n";  // stdout
        echo "stderr:$error\n";  // stderr
    }

    fclose($executePipes[1]);  // Close stdout
    fclose($executePipes[2]);  // Close stderr

    // Wait for the execution process to finish
    $executeExitCode = proc_close($executeProcess);

    echo "execution code:$executeExitCode\n";

    if ($executeExitCode !== 0) {
        echo "node script execution failed with exit code: $executeExitCode\n";
        //send RuntimeError
    }

    else{
        echo "node script execution succeeded with exit code: $executeExitCode\n";
    }
} 

else {
    echo "Failed to execute node script.";
}
?>
