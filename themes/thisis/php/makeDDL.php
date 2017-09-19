<?php
//error_reporting(0);
//mysql_query ("SET NAMES utf8"); //этот запрос исправил кодировку в БД

include ('db_config.php');
$conn = mysql_connect($db_server, $db_user, $db_pass)
or die('Не удалось соединиться: ' . mysql_error());
mysql_select_db('mrsmi176_sadv2') or die('Не удалось выбрать базу данных');

$query = 'SELECT name FROM taxonomy_term_field_data WHERE vid = temy_obavlenii';

$number = mysql_numrows ($query);
echo "string";
$i = 0;

if ($query) {
	while ($i < $number) {
		echo "<option value'";
		echo mysql_result($query,$i,"name");
		echo "'>";
		echo mysql_result($query,$i,"name");
		echo "</option>";
		$i++;
	}
}
else {echo "string";} 
?>