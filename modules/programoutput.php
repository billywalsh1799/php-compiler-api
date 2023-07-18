<?php

echo "compiler";
//timelimit for python and php 10sec 2 for other languages
function program_output($command){
   
    
    //Pepare command to execute script with arguments
    $executeCmd =$command;
    //Prepare pipes
    $executeDescriptorSpec = array(
        0 => array('pipe', 'r'),  // stdin
        1 => array('pipe', 'w'),  // stdout
        2 => array('pipe', 'w')   // stderr
    );
    $executeProcess = proc_open($executeCmd, $executeDescriptorSpec, $executePipes);

    if (is_resource($executeProcess) && is_array($executePipes) && is_resource($executePipes[1])) {
        // Set the maximum execution time  for the process
        $maxExecutionTime =2;
        
        //variable to test whether program exceeded timelimit
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
            //return output
        }
    } 

    else {
        echo "Failed to execute Python script.";
    }
    }


?>