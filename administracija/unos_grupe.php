<?php
include("../include/aplikacija.h.php");
include("../include/admin.h.php");
dbConnect();
adminHeader("PODE&#352;AVANJA - Unos grupe",100);    

prazanRed();

$id=$_REQUEST[id];
$v=new grupa($id);

adminNaslov("GRUPE");
adminLink("- Pregled grupa","grupe.php");
prazanRed(2);

$f=new adminForma("UNOS GRUPE","forma0","unos_grupe1.php",450,150);
$f->hidden("id",$v->id);
$f->pocetakGrupe("OSNOVNI PODACI",1);
$f->prazanRed();
$f->textField("Naziv","naziv",$v->naziv,20,30,1);
$f->prazanRed();
$f->krajGrupe();

$f->pocetakGrupe("DODATNI PODACI",1);
$f->textField("Prioritet izlistavanja","prioritet",$v->prioritet,2,3);
$f->prazanRed();
if (!$id) $aktivno=1; else $aktivno=$v->aktivno; 
$f->checkbox("Unos aktivan","aktivno",1,$aktivno);
unset($aktivno);
$f->krajGrupe();
$f->kraj();
prazanRed(2);




// PODGRUPE ---------------------------------------------------------------------------------- 
if ($v->id)
{
  adminNaslov("PODGRUPE");
  adminLink("- Unos nove podgrupe","unos_podgrupe.php?parent=".$v->id);

  prazanRed();
  $q=new query("select * from ".TAB_PODGRUPE." where parent='".$v->id."' order by prioritet desc, naziv");
  $l=new adminLista(0,"Podgrupe (".$q->rows.")",array("Naziv","Datum"),array(250,120),array("left","right"),LISTA_ICO_DA,LISTA_BRISANJE_DA,LISTA_SELEKTOR_NE);
  $k=0;
  while ($k<$q->rows)
  {
    $vv=new podgrupa($q->row[0]);
    if ($vv->aktivno) $ico="icoListaDoc.gif";
    else $ico="icoListaDocBlok.gif";
    $l->stavka(array($vv->naziv,stampUDatum($vv->stamp_unosa)),"unos_podgrupe.php?parent=".$v->id."&id=".$vv->id,"brisanje_podgrupe.php?parent=".$v->id."&id=".$vv->id,$ico);	  
    unset($vv,$ico);
    $q->fetchRow();
    $k++;
  }
  $l->kraj();	  
  prazanRed(2);
}

adminFooter();
dbDisconnect();
?>