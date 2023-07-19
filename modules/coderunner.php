<?php

require "programfile.php";
require "command.php";
require "programoutput.php";

echo "coderunner\n";

function code_evaluation($language,$code){
    try {
        //write code to file and get path
        $file=program_file($language,$code);
        echo "filepath:$file\n";

        //prepare command with language filepath and arguments
        $command=prepare_command($language,$file,"al pacino","robert deniro");
        echo "command:$command\n";

        //execute script and retrieve output
        $output=program_output($command);
        echo "output:$output";

    } catch (Exception $e) {
        $message =  $e->getMessage();
        echo"error:$message";

    }

}

$language="python";
$code=
"import sys
for i in range (3):
    print(\"hello python\")";
code_evaluation($language,$code);


?>