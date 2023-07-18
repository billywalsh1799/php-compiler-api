<?php
// Online PHP compiler to run PHP program online
// Print "Hello World!" message
echo "Hello from php!\n";

echo "arguments: [";

$arguments=$argv;
array_shift($arguments);

/* foreach ($arguments as $arg) {
    echo "$arg,";
} */

for($i=0;$i<count($arguments);$i++){
    if($i==count($arguments)-1){
        echo "$arguments[$i]]\n";
    }

    else{
        echo "$arguments[$i],";
    }
}

//echo "]\n";
?>