<?php
include("../include/aplikacija.h.php");

dbConnect();

@$tab__vesti=mysql_query("create table ".TAB_VESTI."
	(
	  id integer auto_increment,
	  naslov varchar(255),
	  tekst_kratki text,
      tekst text,
           
	  aktivno tinyint NOT NULL,
	  prioritet tinyint NOT NULL,    
	  
	  stamp_unosa varchar(14),
	  stamp_izmene varchar(14),	  
	  PRIMARY KEY (id)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8
	");
	


if (!$tab__vesti)
{
  echo "<br><b>Tabela ".TAB_VESTI." NIJE napravljena...</b>";
}
else
{
  echo "<br><b>Tabela ".TAB_VESTI." napravljena...</b>";
}



dbDisconnect();

?>
