<?php
include("../include/aplikacija.h.php");

dbConnect();

@$tab__slike=mysql_query("create table ".TAB_SLIKE."
	(
	  id integer auto_increment,
	  id_objekta int,
	  vrsta varchar(30),
	  indeks tinyint NOT NULL,
	  naziv varchar(50),
	  naziv_mala varchar(50),
	  naziv_srednja varchar(50),
	  ext varchar(10),
	  sirina varchar(10),
	  visina varchar(10),
	  komentar varchar(255),
	  
	  stamp_unosa varchar(14),
	  PRIMARY KEY (id)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8
	");
	


if (!$tab__slike)
{
  echo "<br><b>Tabela ".TAB_SLIKE." NIJE napravljena...</b>";
}
else
{
  echo "<br><b>Tabela ".TAB_SLIKE." napravljena...</b>";
}

dbDisconnect();

?>
