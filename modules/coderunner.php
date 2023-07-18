<?php

require "programfile.php";

echo "coderunner\n";

function code_evaluation($language,$code){
    try {
        $output=program_file($language,$code);
        echo "output:$output";
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