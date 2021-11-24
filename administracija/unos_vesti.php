<?php
include("../include/aplikacija.h.php");
include("../include/admin.h.php");
dbConnect();
adminHeader("VESTI - Unos vesti",99);    

prazanRed();

$id=$_REQUEST[id];
$v=new vest($id);

$f=new adminForma("UNOS VESTI","forma0","unos_vesti1.php",650,120);
$f->hidden("id",$v->id);

$f->pocetakGrupe("OSNOVNI PODACI",1);
$f->textField("Naslov","naslov",$v->naslov,35,50,1);
$f->prazanRed(2);
$f->textArea2("Kratak tekst","tekst_kratki",$v->tekst_kratki,1,70,5);
$f->prazanRed(2);
$f->textArea2("Tekst","tekst",$v->tekst,1,70,20);
$f->prazanRed(2);
$f->krajGrupe();


$i=1;
while ($i<=MAX_SLIKA_PO_VESTI)
{
  if ($v->slike[$i]->naziv) $otvoreno=1;
  else $otvoreno=0;
  $f->pocetakGrupe("SLIKA ".$i,$otvoreno);
  $f->slika("Slika ".$i,"slika".$i,SL_VEST,$v->id,$i,"brisanje_slike_vesti.php?id=".$v->id."&indeks=".$i,0);
  unset($otvoreno);
  $f->krajGrupe();
  $i++;
}


$f->pocetakGrupe("DODATNI PODACI",1);
//$f->textField("Prioritet izlistavanja","prioritet",$v->prioritet,2,3);
$f->prazanRed();
if (!$id) $aktivno=1; else $aktivno=$v->aktivno; 
$f->checkbox("Unos aktivan","aktivno",1,$aktivno);
unset($aktivno);
$f->krajGrupe();


$f->kraj();
prazanRed();

adminFooter();
dbDisconnect();
?>