<?php
include("../include/aplikacija.h.php");    
include("../include/admin.h.php");
dbConnect();
adminHeader("PODE&#352;AVANJA - Grupe",100);

prazanRed();

adminNaslov("GRUPE");
adminLink("- Unos nove grupe","unos_grupe.php");
prazanRed(2);

$q=new query("select * from ".TAB_GRUPE." where id>0 order by prioritet desc, naziv");

$l=new adminLista(0,"GRUPE",array("Naziv","Broj podgrupa","Datum"),array(200,100,120),array("left","right","right"),LISTA_ICO_DA,LISTA_BRISANJE_DA,LISTA_SELEKTOR_NE);
$i=0;
while ($i<$q->rows)
{
  $v=new grupa($q->row[0]);
  $qc=new query("select * from ".TAB_PODGRUPE." where parent='".$v->id."' order by prioritet, naziv");
  if ($v->aktivno) $ico="icoListaDoc.gif"; else $ico="icoListaDocBlok.gif";
  $l->stavka(array($v->naziv,$qc->rows,stampUDatum($v->stamp_unosa)),"unos_grupe.php?id=".$v->id,"brisanje_grupe.php?id=".$v->id,$ico);
      
  unset($v,$ico,$qc);
  $q->fetchRow();
  $i++;
}
$l->kraj();
prazanRed(2);
 

adminFooter();
dbDisconnect();
?>