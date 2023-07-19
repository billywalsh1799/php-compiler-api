<?php

//echo "compiler\n";
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
                //echo "time limit exceeded\n";
                //send TimeLimit
                //throw new Exception("TimeLimit Exceeded"); throw it in condition
            }
        }
        
        if($timeLimit==0){
            //program executed whithin timelimit
            // Read and display the program's output
            $output= stream_get_contents($executePipes[1]);  // stdout
            $error= stream_get_contents($executePipes[2]);  // stderr

            fclose($executePipes[1]);  // Close stdout
            fclose($executePipes[2]);  // Close stderr


            //close process and get execution exit code
            $executeExitCode = proc_close($executeProcess);
            
            if ($executeExitCode !== 0) {
                throw new Exception("RunTime Error:$error");
                //send RuntimeError
            }

            else{
                //echo "python script execution succeeded with exit code: $executeExitCode\n";
                //return output
                return $output;
            }

        }

        else{
            //program exceeded timelimit
            //close pipes
            fclose($executePipes[1]);  // Close stdout
            fclose($executePipes[2]);  // Close stderr
            proc_close($executeProcess);//ensure process is closed
            throw new Exception("TimeLimit Exceeded");
        }

    } 

    else {
        throw new Exception("Failed to execute Python script");
    }


}

/* try{
    $result=program_output("node test.js");
    echo "output:$result";
}
catch(Exception $e){
    $message =  $e->getMessage();
    echo"error:$message\n";
}
echo "test line"; */

?>