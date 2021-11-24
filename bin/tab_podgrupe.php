<?php
include("../include/aplikacija.h.php");

dbConnect();

@$tab__podgrupe=mysql_query("create table ".TAB_PODGRUPE."
    (
      id integer auto_increment,
      parent int NOT NULL,
      naziv varchar(50),
      aktivno tinyint NOT NULL,
      prioritet int NOT NULL,
      
      stamp_unosa varchar(14),
      stamp_izmene varchar(14),      
      PRIMARY KEY (id)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8
    ");
    


if (!$tab__podgrupe)
{
  echo "<br><b>Tabela ".TAB_PODGRUPE." NIJE napravljena...</b>";
}
else
{
  echo "<br><b>Tabela ".TAB_PODGRUPE." napravljena...</b>";
}

$stamp=stamp();

mysql_query("insert into ".TAB_PODGRUPE." (parent,naziv,aktivno,prioritet,stamp_unosa,stamp_izmene) values ('1','Komunikacija','1','10','".$stamp."','".$stamp."')");
mysql_query("insert into ".TAB_PODGRUPE." (parent,naziv,aktivno,prioritet,stamp_unosa,stamp_izmene) values ('1','Seks','1','8','".$stamp."','".$stamp."')");
mysql_query("insert into ".TAB_PODGRUPE." (parent,naziv,aktivno,prioritet,stamp_unosa,stamp_izmene) values ('1','Finansije','1','6','".$stamp."','".$stamp."')");
mysql_query("insert into ".TAB_PODGRUPE." (parent,naziv,aktivno,prioritet,stamp_unosa,stamp_izmene) values ('1','Sukobi u braku','1','4','".$stamp."','".$stamp."')");
mysql_query("insert into ".TAB_PODGRUPE." (parent,naziv,aktivno,prioritet,stamp_unosa,stamp_izmene) values ('1','Razvod','1','2','".$stamp."','".$stamp."')");
mysql_query("insert into ".TAB_PODGRUPE." (parent,naziv,aktivno,prioritet,stamp_unosa,stamp_izmene) values ('1','Nasilje u porodici','1','0','".$stamp."','".$stamp."')");

mysql_query("insert into ".TAB_PODGRUPE." (parent,naziv,aktivno,prioritet,stamp_unosa,stamp_izmene) values ('2','Otac','1','10','".$stamp."','".$stamp."')");
mysql_query("insert into ".TAB_PODGRUPE." (parent,naziv,aktivno,prioritet,stamp_unosa,stamp_izmene) values ('2','Muž','1','8','".$stamp."','".$stamp."')");
mysql_query("insert into ".TAB_PODGRUPE." (parent,naziv,aktivno,prioritet,stamp_unosa,stamp_izmene) values ('2','Posao','1','6','".$stamp."','".$stamp."')");

mysql_query("insert into ".TAB_PODGRUPE." (parent,naziv,aktivno,prioritet,stamp_unosa,stamp_izmene) values ('3','Mlada žena','1','10','".$stamp."','".$stamp."')");
mysql_query("insert into ".TAB_PODGRUPE." (parent,naziv,aktivno,prioritet,stamp_unosa,stamp_izmene) values ('3','Zrela žena','1','8','".$stamp."','".$stamp."')");
mysql_query("insert into ".TAB_PODGRUPE." (parent,naziv,aktivno,prioritet,stamp_unosa,stamp_izmene) values ('3','Tinejdžerka','1','6','".$stamp."','".$stamp."')");
mysql_query("insert into ".TAB_PODGRUPE." (parent,naziv,aktivno,prioritet,stamp_unosa,stamp_izmene) values ('3','Samohrana majka','1','4','".$stamp."','".$stamp."')");

mysql_query("insert into ".TAB_PODGRUPE." (parent,naziv,aktivno,prioritet,stamp_unosa,stamp_izmene) values ('4','Vaspitavanje','1','10','".$stamp."','".$stamp."')");
mysql_query("insert into ".TAB_PODGRUPE." (parent,naziv,aktivno,prioritet,stamp_unosa,stamp_izmene) values ('4','Školska deca','1','8','".$stamp."','".$stamp."')");

mysql_query("insert into ".TAB_PODGRUPE." (parent,naziv,aktivno,prioritet,stamp_unosa,stamp_izmene) values ('5','Duh','1','10','".$stamp."','".$stamp."')");
mysql_query("insert into ".TAB_PODGRUPE." (parent,naziv,aktivno,prioritet,stamp_unosa,stamp_izmene) values ('5','Telo','1','8','".$stamp."','".$stamp."')");


dbDisconnect();

?>
