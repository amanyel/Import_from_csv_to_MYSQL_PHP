<?php
// specify connection info
$connect = mysql_connect('localhost','username','password');
if (!$connect)
{
   die('Could not connect to MySQL: ' . mysql_error());
}

//specify db name
$cid =mysql_select_db('test',$connect); 

// specify CSV file path
define('CSV_PATH','C:/wamp/www/csvfile/');

// Name of your CSV file
$csv_file = CSV_PATH . "file.csv"; 
$csvfile = fopen($csv_file, 'r');
$theData = fgets($csvfile);
$i = 0;
while (!feof($csvfile))
{
   $csv_data[] = fgets($csvfile, 1024);
   $csv_array = explode(",", $csv_data[$i]);
   $insert_csv = array();
   $insert_csv['ID'] = $csv_array[0];
   $insert_csv['name'] = $csv_array[1];
   $insert_csv['email'] = $csv_array[2];
   $query = "INSERT INTO csvdata(ID,name,email)
     VALUES('','".$insert_csv['name']."','".$insert_csv['email']."')";
   $n=mysql_query($query, $connect );
   $i++;
}
fclose($csvfile);
echo "File data successfully imported to database!!";
// closing connection
mysql_close($connect); 
?>