<?php
include("../include/aplikacija.h.php");

dbConnect();

@$tab__clanci=mysql_query("create table ".TAB_CLANCI."
	(
	  id integer auto_increment,
	  parent int NOT NULL,
	  naslov varchar(255),
	  tekst_kratki text,
      tekst text,
      povezani1 tinyint NOT NULL,
      povezani2 tinyint NOT NULL,
      povezani3 tinyint NOT NULL,
      povezani4 tinyint NOT NULL,
            
	  aktivno tinyint NOT NULL,
	  prioritet tinyint NOT NULL,    
	  
	  stamp_unosa varchar(14),
	  stamp_izmene varchar(14),	  
	  PRIMARY KEY (id)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8
	");
	


if (!$tab__clanci)
{
  echo "<br><b>Tabela ".TAB_CLANCI." NIJE napravljena...</b>";
}
else
{
  echo "<br><b>Tabela ".TAB_CLANCI." napravljena...</b>";
}



dbDisconnect();

?>
