<?php

include 'mysql.php';

$query = "SELECT * FROM `tweets` WHERE `active` = '1' ORDER BY `id` DESC LIMIT 1";
$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {


	$nick = $row["screen_name"];
	$msg = $row["msg"];

	echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
	echo "<tweet>\n";
	echo "<nick>@".$nick."</nick>\n";
	echo "<msg>".$msg."</msg>\n";
	echo "</tweet>\n";

}



?>
