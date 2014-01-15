<?php
echo "traitement fichier csv";

if($argc>2)
{
$row = 1;

// open the file with read permission
if (($handle = fopen($argv[1], "r")) !== FALSE)
{
while (($data = fgetcsv($handle, 0, ",")) !== FALSE)
{
//count the number of fields
$num = count($data);
echo "<p> $num fields in line $row: <br /></p>\n"; $row++;

for ($c=0; $c < $num; $c++)
{
echo $data[$c] . "<br />\n";
}

//end for
} //end while

fclose($handle); //close file handler
}
}


?>