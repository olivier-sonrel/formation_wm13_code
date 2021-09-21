<?php
echo "Hello! What is your name (enter below):\n";
$strName = fread(STDIN, 80);
echo 'Hello ' , $strName , "\n";
?>