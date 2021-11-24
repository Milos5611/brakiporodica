<?php
include("../include/aplikacija.h.php");

dbConnect();

@$tab__grupe=mysql_query("create table ".TAB_GRUPE."
	(
	  id integer auto_increment,
	  naziv varchar(50),
	  aktivno tinyint NOT NULL,
	  prioritet int NOT NULL,
	  
	  stamp_unosa varchar(14),
	  stamp_izmene varchar(14),	  
	  PRIMARY KEY (id)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8
	");
	


if (!$tab__grupe)
{
  echo "<br><b>Tabela ".TAB_GRUPE." NIJE napravljena...</b>";
}
else
{
  echo "<br><b>Tabela ".TAB_GRUPE." napravljena...</b>";
}

$stamp=stamp();

mysql_query("insert into ".TAB_GRUPE." (naziv,aktivno,prioritet,stamp_unosa,stamp_izmene) values ('Brak','1','10','".$stamp."','".$stamp."')");
mysql_query("insert into ".TAB_GRUPE." (naziv,aktivno,prioritet,stamp_unosa,stamp_izmene) values ('Muškarac','1','8','".$stamp."','".$stamp."')");
mysql_query("insert into ".TAB_GRUPE." (naziv,aktivno,prioritet,stamp_unosa,stamp_izmene) values ('Žena','1','6','".$stamp."','".$stamp."')");
mysql_query("insert into ".TAB_GRUPE." (naziv,aktivno,prioritet,stamp_unosa,stamp_izmene) values ('Deca','1','4','".$stamp."','".$stamp."')");
mysql_query("insert into ".TAB_GRUPE." (naziv,aktivno,prioritet,stamp_unosa,stamp_izmene) values ('Duh i telo','1','2','".$stamp."','".$stamp."')");


dbDisconnect();

?>
