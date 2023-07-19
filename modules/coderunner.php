<?php

require "programfile.php";
require "command.php";

echo "coderunner\n";

function code_evaluation($language,$code){
    try {
        $file=program_file($language,$code);
        echo "filepath:$file\n";
        $command=prepare_command($language,$file,"al pacino","robert deniro");
        echo "command:$command\n";
    } catch (Exception $e) {
        $message =  $e->getMessage();
        echo"error:$message";

    }

}

$language="python";
$code=
"for i in range i:
    print(\"hello python\")";
code_evaluation($language,$code);


?>