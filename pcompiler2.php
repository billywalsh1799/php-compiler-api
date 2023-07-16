<?php

echo "python compiler\n";
$pythonFile ="test2.py";  // Replace with the actual path to your Python file
// Multiple arguments to be passed
$arg1 = "al pacino";
$arg2 = "robert deniro";
$arg3 = "brad pitt";

//push arguments to an array
$arguments = array($arg1,$arg2,$arg3);

//Pepare command to execute script with arguments
$executeCmd = "python $pythonFile " . escapeshellarg($arg1) . " " . escapeshellarg($arg2) . " " . escapeshellarg($arg3);

// Concatenate the arguments with a delimiter
//$inputData = $arg1 . "|" . $arg2 . "|" . $arg3;


$executeDescriptorSpec = array(
    0 => array('pipe', 'r'),  // stdin
    1 => array('pipe', 'w'),  // stdout
    2 => array('pipe', 'w')   // stderr
);
$executeProcess = proc_open($executeCmd, $executeDescriptorSpec, $executePipes);

if (is_resource($executeProcess) && is_array($executePipes)) {
    
    // Pass input data to the Python script
    //fwrite($executePipes[0], $inputData);
    //fclose($executePipes[0]);  // Close stdin
    
    // Set the maximum execution time  for the process
    $maxExecutionTime =2;
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
            proc_terminate($executeProcess);
            // Additional handling for the termination
            // ...
            $timeLimit=1;
            echo "time limit exceeded\n";
            //send TimeLimit

        }
    }
    
    //if time limit exceeded do not get stream contents

    if($timeLimit==0){
        //program executed whithin timelimit
        // Read and display the program's output
        $output= stream_get_contents($executePipes[1]);  // stdout
        $error= stream_get_contents($executePipes[2]);  // stderr

        echo "stdout:$output";  // stdout
        echo "stderr:$error\n";  // stderr
    }

    fclose($executePipes[1]);  // Close stdout
    fclose($executePipes[2]);  // Close stderr

    // Wait for the execution process to finish
    $executeExitCode = proc_close($executeProcess);

    echo "execution code:$executeExitCode\n";

    if ($executeExitCode !== 0) {
        echo "Python script execution failed with exit code: $executeExitCode\n";
        //send RuntimeError
    }

    else{
        echo "python script execution succeeded with exit code: $executeExitCode\n";
    }
} 

else {
    echo "Failed to execute Python script.";
}
?>
