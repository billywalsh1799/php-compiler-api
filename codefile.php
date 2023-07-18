<?php

/* $language="php";
$code=
"<?php
    echo 'program file saved in temp';
?>";
 */

$language="py";
/* $code=
"for i in range(5):
    print('asba')
"; */

echo "file";
$random = substr(md5(mt_rand()), 0, 7);
$filePath = "temp/" ."program" . "." . $language;
$programFile = fopen($filePath, "w");
$code=1;
fwrite($programFile, $code);
fclose($programFile);

?>