<?php
include("../include/aplikacija.h.php");

dbConnect();

@$tab__stranice=mysql_query("create table ".TAB_STRANICE."
	(
	  id integer auto_increment,
	  naziv varchar(50),
      naslov varchar(100),
      tekst text,
	  
	  stamp_unosa varchar(14),
	  stamp_izmene varchar(14),	  
	  PRIMARY KEY (id)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8
	");
	


if (!$tab__stranice)
{
  echo "<br><b>Tabela ".TAB_STRANICE." NIJE napravljena...</b>";
}
else
{
  echo "<br><b>Tabela ".TAB_STRANICE." napravljena...</b>";
}

$stamp=stamp();

mysql_query("insert into ".TAB_STRANICE." (naziv,naslov,tekst,stamp_unosa,stamp_izmene) values ('O nama','O nama','','".$stamp."','".$stamp."')");
mysql_query("insert into ".TAB_STRANICE." (naziv,naslov,tekst,stamp_unosa,stamp_izmene) values ('Mediji','Mediji','','".$stamp."','".$stamp."')");
mysql_query("insert into ".TAB_STRANICE." (naziv,naslov,tekst,stamp_unosa,stamp_izmene) values ('Vikend','Vikend za secanje','','".$stamp."','".$stamp."')");
mysql_query("insert into ".TAB_STRANICE." (naziv,naslov,tekst,stamp_unosa,stamp_izmene) values ('Kamp','Kamp ocevi i sinovi','','".$stamp."','".$stamp."')");
mysql_query("insert into ".TAB_STRANICE." (naziv,naslov,tekst,stamp_unosa,stamp_izmene) values ('Upomoc','Upomoc, ja se zenim!','','".$stamp."','".$stamp."')");
mysql_query("insert into ".TAB_STRANICE." (naziv,naslov,tekst,stamp_unosa,stamp_izmene) values ('Savetovanje','Bracno savetovanje','','".$stamp."','".$stamp."')");


dbDisconnect();

?>
