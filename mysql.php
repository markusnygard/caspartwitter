<?php

//Default timezone
date_default_timezone_set('Europe/Warsaw');

//Łaczymy się z bazą

//Nazwa użytkownika
$user = "root";

//Hasło
$pass = "*";

//Nazwa bazy danych
$database = "caspartwitter";


//Połączenie z serwerem - stara wersja
mysql_connect('localhost',$user,$pass);



//Komunikat błędu w przypadku braku możliwości połączenia z bazą
@mysql_select_db($database) or die ("Nie moge polaczyc sie z baza");

//Ustawiamy kodowanie:

mysql_query("SET NAMES `utf8`");

?>

