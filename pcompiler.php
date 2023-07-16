<?php

echo "python compiler\n";
$pythonFile ="test.py";  // Replace with the actual path to your Python file
// Multiple arguments to be passed
$arg1 = "al pacino";
$arg2 = "robert deniro";
$arg3 = "brad pitt";


// Execute the Python script
$executeCmd = "python $pythonFile";

// Concatenate the arguments with a delimiter
$inputData = $arg1 . "|" . $arg2 . "|" . $arg3;


$executeDescriptorSpec = array(
    0 => array('pipe', 'r'),  // stdin
    1 => array('pipe', 'w'),  // stdout
    2 => array('pipe', 'w')   // stderr
);
$executeProcess = proc_open($executeCmd, $executeDescriptorSpec, $executePipes);

if (is_resource($executeProcess) && is_array($executePipes) && is_resource($executePipes[1])) {
    //fclose($executePipes[0]);  // Close stdin
    // Set the timeout for the process
    //stream_set_timeout($pipes[1], 2); // stdout timeout
    //stream_set_timeout($pipes[2], 2); // stderr timeout
    // Read and display the program's output
    //$output= stream_get_contents($executePipes[1]);  // stdout
    //$error= stream_get_contents($executePipes[2]);  // stderr


    // Pass input data to the Python script
    fwrite($executePipes[0], $inputData);
    fclose($executePipes[0]);  // Close stdin

    // Set the timeout for the process
    //stream_set_timeout($executePipes[1], 1); // stdout timeout
    //stream_set_timeout($executePipes[2], 2); // stderr timeout

    $maxExecutionTime =1;
    // Sleep for the desired duration
    sleep($maxExecutionTime);
    $status = proc_get_status($executeProcess);
    echo "before status:".proc_get_status($executeProcess)['running']."\n";
    $timeLimit=0;
    if ($status['running']) {
        // Process is still running, terminate it
        proc_terminate($executeProcess);

        // Additional handling for the termination
        // ...
        $timeLimit=1;
        echo "time limit exceeded\n";
    }

    echo "after status:".proc_get_status($executeProcess)['running']."\n";

    //if time limit exceeded do not get stream contents

    if($timeLimit==0){
        $output= stream_get_contents($executePipes[1]);  // stdout
        $error= stream_get_contents($executePipes[2]);  // stderr

        echo "stdout:$output";  // stdout
        echo "stderr:$error\n";  // stderr
    }

    

    

    //echo "stdout:$output";  // stdout
    //echo "stderr:$error\n";  // stderr

    // Get the stream metadata
    //$metaData = stream_get_meta_data($executePipes[1]);
    //printing metadata;
    //$timeout=$metaData['timed_out'];
    //echo "timeout:$timeout\n";

    //testing meta data

    fclose($executePipes[1]);  // Close stdout
    fclose($executePipes[2]);  // Close stderr

    // Wait for the execution process to finish
    $executeExitCode = proc_close($executeProcess);

    echo "execution code:$executeExitCode\n";

    if ($executeExitCode !== 0) {
        echo "Python script execution failed with exit code: $executeExitCode\n";
    }

    else{
        echo "python script execution succeeded with exit code: $executeExitCode\n";
    }
} 

else {
    echo "Failed to execute Python script.";
}
?>
