<?php
include("../include/aplikacija.h.php");
include("../include/admin.h.php");
dbConnect();
adminHeader("VESTI - Pregled vesti",99);
prazanRed();

$query="select * from ".TAB_VESTI." where id>0";

$strana=$_REQUEST[strana];
if (!$strana) $strana=1;
$lim=($strana-1)*ADMIN_MAX_VESTI;

$order=" order by stamp_unosa desc";
$limit=" limit ".$lim.",".ADMIN_MAX_VESTI;

$qb=new query($query);
$q=new query($query.$order.$limit);

$l=new adminLista(0,"VESTI",array("Naslov","Datum"),array(350,120),array("left","right"),LISTA_ICO_DA,LISTA_BRISANJE_DA,LISTA_SELEKTOR_DA);

$l->br_rezultata=$qb->rows;
$l->max_rezultata=ADMIN_MAX_VESTI;
$l->strana=$strana;

$i=0;
while ($i<$q->rows)
{
  $v=new vest($q->row[0]);
  if ($v->aktivno) $ico="icoListaDoc.gif";
  else $ico="icoListaDocBlok.gif";

  $link="brisanje_vesti.php?id=".$v->id;
  if ($strana) $link.="&strana=".$strana;
  
  $l->stavka(array($v->naslov,stampUDatum($v->stamp_unosa)),"unos_vesti.php?id=".$v->id,$link,$ico);
  unset($ico,$v,$link);
  $q->fetchRow();
  $i++;
}
$l->kraj();
unset($q,$qb,$i); 


adminFooter();
dbDisconnect();
?>