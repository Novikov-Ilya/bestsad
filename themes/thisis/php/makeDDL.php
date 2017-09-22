<?php
//error_reporting(0);
//mysql_query ("SET NAMES utf8"); //этот запрос исправил кодировку в БД

include ('db_config.php');
$conn = mysql_connect('localhost', 'root', '')
or die('Не удалось соединиться: ' . mysql_error());
mysql_select_db($db_name, $conn) or die('Не удалось выбрать базу данных');

$query = mysql_query ("SELECT name, field_theme_advert_url_value FROM taxonomy_term_field_data, taxonomy_term__field_theme_advert_url WHERE entity_id = tid");

$number = mysql_numrows ($query);

$i = 0;


if ($query) {
	while ($i < $number) {
		echo "<option value='";
		echo mysql_result($query,$i,"field_theme_advert_url_value");
		echo "'>";
		echo mysql_result($query,$i,"name");
		echo "</option>";
		$i++;
	}
}
else {echo "Нет соединения с БД";} 
mysql_close();
?>