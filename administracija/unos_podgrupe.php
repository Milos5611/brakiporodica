<?php
include("../include/aplikacija.h.php");
include("../include/admin.h.php");
dbConnect();
adminHeader("PODE&#352;AVANJA - Unos podgrupe",100);     

prazanRed();

$id=$_REQUEST[id];
$v=new podgrupa($id);

$parent=$_REQUEST[parent];
if (!$parent && $id)
{
   $qp=new query("select id from ".TAB_GRUPE." where id='".$v->parent."'");
   $parent=$qp->row[0];
   unset($qp);
}
$p=new grupa($parent);

adminNaslov("GRUPE I PODGRUPE");
adminLink("- Pregled grupa","grupe.php");
adminLink("- Pregled podgrupa","unos_grupe.php?id=".$parent);
prazanRed(2);

$f=new adminForma("UNOS PODGRUPE","forma0","unos_podgrupe1.php",450,150);
$f->hidden("id",$v->id);
$f->hidden("parent",$parent); 
$f->pocetakGrupe("OSNOVNI PODACI",1);
$f->prazanRed();
$f->podatak("Grupa",$p->naziv);
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



adminFooter();
dbDisconnect();
?>