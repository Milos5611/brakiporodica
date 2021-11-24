<?php
include("../include/aplikacija.h.php");

dbConnect();

@$tab__uvodi=mysql_query("create table ".TAB_UVODI."
	(
	  id integer auto_increment,
      grupa int NOT NULL,
	  naziv varchar(50),
      naslov varchar(50),
      tekst text,
	  
	  stamp_unosa varchar(14),
	  stamp_izmene varchar(14),	  
	  PRIMARY KEY (id)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8
	");
	


if (!$tab__uvodi)
{
  echo "<br><b>Tabela ".TAB_UVODI." NIJE napravljena...</b>";
}
else
{
  echo "<br><b>Tabela ".TAB_UVODI." napravljena...</b>";
}

$stamp=stamp();

mysql_query("insert into ".TAB_UVODI." (grupa,naziv,naslov,tekst,stamp_unosa,stamp_izmene) values ('0','Home','Naslov za home','Tekst za home','".$stamp."','".$stamp."')");
mysql_query("insert into ".TAB_UVODI." (grupa,naziv,naslov,tekst,stamp_unosa,stamp_izmene) values ('1','Brak','Naslov o braku','Tekst o braku','".$stamp."','".$stamp."')");
mysql_query("insert into ".TAB_UVODI." (grupa,naziv,naslov,tekst,stamp_unosa,stamp_izmene) values ('2','Muskarac','Naslov o muskarcu','Tekst o muskarcu','".$stamp."','".$stamp."')");
mysql_query("insert into ".TAB_UVODI." (grupa,naziv,naslov,tekst,stamp_unosa,stamp_izmene) values ('3','Zena','Naslov o zeni','Tekst o zeni','".$stamp."','".$stamp."')");
mysql_query("insert into ".TAB_UVODI." (grupa,naziv,naslov,tekst,stamp_unosa,stamp_izmene) values ('4','Deca','Naslov o deci','Tekst o deci','".$stamp."','".$stamp."')");
mysql_query("insert into ".TAB_UVODI." (grupa,naziv,naslov,tekst,stamp_unosa,stamp_izmene) values ('5','Duh i telo','Naslov o duhu i telu','Tekst o duhu i telu','".$stamp."','".$stamp."')");



dbDisconnect();

?>
