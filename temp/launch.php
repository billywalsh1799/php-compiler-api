<?php


echo "launch\n";
$test=file_exists("output.php");
if($test)
    echo "file exsists";
else
    echo "file not found";

?>