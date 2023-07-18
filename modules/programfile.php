<?php

echo "programfile";


//returns path of program to compile
function program_file($language,$code){
    $random = substr(md5(mt_rand()), 0, 7);
    if($language=="python"){
        $filePath = "temp/program$random.py";
        $programFile = fopen($filePath, "w");
        fwrite($programFile, $code);
        fclose($programFile);
        return $filePath;
    }

    else if($language=="php"){
        $filePath = "temp/program$random.php" ;
        $programFile = fopen($filePath, "w");
        fwrite($programFile, $code);
        fclose($programFile);
        return $filePath;

    }

    else if($language=="node"){
        $filePath = "temp/program$random.js" ;
        $programFile = fopen($filePath, "w");
        fwrite($programFile, $code);
        fclose($programFile);
        return $filePath;
    }

    else{
        return "error";
    }

}

?>